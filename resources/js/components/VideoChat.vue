<template>
  <div class="video-chat-container">
    <div class="container">
      <!-- Video Call Icon and Video Window -->
      <h1>Video Chat</h1>
      <div class="row mt-5 video-row" v-if="showVideoWindow">
        <div class="col-12 video-container">
          <div v-if="timeLeft > 0" class="timer">
            Time left: {{ formatTime(timeLeft) }}
          </div>
          <video
            ref="userVideo"
            muted
            playsinline
            autoplay
            class="cursor-pointer"
            :class="isFocusMyself ? 'user-video' : 'partner-video'"
            @click="toggleCameraArea"
          />
          <video
            ref="partnerVideo"
            playsinline
            autoplay
            class="cursor-pointer"
            :class="isFocusMyself ? 'partner-video' : 'user-video'"
            @click="toggleCameraArea"
            v-if="videoCallParams.callAccepted"
          />
          <div class="partner-video" v-else>
            <div v-if="callPartner" class="column items-center q-pt-xl">
              <div class="col q-gutter-y-md text-center">
                <p class="q-pt-md">
                  <strong>{{ callPartner }}</strong>
                </p>
                <p>calling...</p>
              </div>
            </div>
          </div>
          <div class="action-btns">
            <button type="button" class="btn btn-info" @click="toggleMuteAudio">
              {{ mutedAudio ? "Unmute" : "Mute" }}
            </button>
            <button
              type="button"
              class="btn btn-primary mx-4"
              @click="toggleMuteVideo"
            >
              {{ mutedVideo ? "Show Video" : "Hide Video" }}
            </button>
            <button type="button" class="btn btn-danger" @click="endCall">
              End Call
            </button>
          </div>
        </div>
      </div>
      <!-- Incoming Call -->
      <div class="row" v-if="incomingCallDialog">
        <div class="col">
          <p>
            Incoming Call From <strong>{{ callerDetails.name }}</strong>
          </p>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger" @click="declineCall">
              Decline
            </button>
            <button
              type="button"
              class="btn btn-success ml-5"
              @click="acceptCall"
            >
              Accept
            </button>
          </div>
        </div>
      </div>
      <!-- End of Incoming Call -->
    </div>

    <div class="logs">
      <h3>Logs and WebRTC Details:</h3>
      <ul>
        <li v-for="(log, index) in logs" :key="index">{{ log }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
import Peer from "simple-peer";
import { getPermissions } from "../helper";

export default {
  props: {
    auth_user_id: {
      type: [String, Number],
      required: true,
    },
    recipient_user_id: {
      type: [String, Number],
      required: true,
    },
    recipient_user_name: {
      type: String,
      required: true,
    },
    turn_url: {
      type: String,
      required: true,
    },
    turn_username: {
      type: String,
      required: true,
    },
    turn_credential: {
      type: String,
      required: true,
    },
    time_limit: {
      type: Number,
      default: 300, // Default to 5 minutes
      required: true,
    },
  },
  data() {
    return {
      isFocusMyself: true,
      showVideoWindow: false,
      callPlaced: false,
      callPartner: null,
      mutedAudio: false,
      mutedVideo: false,
      logs: [],
      videoCallParams: {
        stream: null,
        receivingCall: false,
        caller: null,
        callerSignal: null,
        callAccepted: false,
        channel: null,
        peer: null,
      },
      timeLeft: 0,
      timerInterval: null,
    };
  },
  mounted() {
    window.videoComponent = this;
    console.log("Video component initialized:", window.videoComponent);
    this.initializeChannel(); // Initializes Laravel Echo
    this.initializeCallListeners(); // Subscribes to video presence channel and listens to video events
    this.timeLeft = this.time_limit; // Initialize timer with time limit
  },
  beforeDestroy() {
    clearInterval(this.timerInterval);
  },
  computed: {
    incomingCallDialog() {
      return (
        this.videoCallParams.receivingCall &&
        this.videoCallParams.caller !== this.auth_user_id
      );
    },
    callerDetails() {
      return {
        id: this.videoCallParams.caller,
        name: this.recipient_user_name,
      };
    },
  },
  methods: {
    initializeChannel() {
      this.videoCallParams.channel = window.Echo.join("presence-video-channel");
      this.log(`User ${this.auth_user_id} joined the presence-video-channel.`);
      console.log(
        `User ${this.auth_user_id} joined the presence-video-channel.`
      );
      console.log(
        `Placing video call with time limit: ${this.time_limit} seconds to user ${this.recipient_user_id} ${this.recipient_user_name}`
      );
    },

    getMediaPermission() {
      return getPermissions()
        .then((stream) => {
          this.videoCallParams.stream = stream;
          if (this.$refs.userVideo) {
            this.$refs.userVideo.srcObject = stream;
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    initializeCallListeners() {
      this.videoCallParams.channel.here((users) => {
        this.log("Users currently in the channel: " + JSON.stringify(users));
        console.log("Users currently in the channel:", users);
      });

      this.videoCallParams.channel.joining((user) => {
        this.log("User joined the channel: " + JSON.stringify(user));
        console.log("User joined the channel:", user);
      });

      this.videoCallParams.channel.leaving((user) => {
        this.log("User left the channel: " + JSON.stringify(user));
        console.log("User left the channel:", user);
      });

      this.videoCallParams.channel.listen("StartVideoChat", ({ data }) => {
        if (data.type === "incomingCall") {
          const updatedSignal = {
            ...data.signalData,
            sdp: `${data.signalData.sdp}\n`,
          };
          this.videoCallParams.receivingCall = true;
          this.videoCallParams.caller = data.from;
          this.videoCallParams.callerSignal = updatedSignal;
          this.playIncomingCallSound();
          this.log("Incoming call from: " + data.from);
          console.log("Incoming call from: " + data.from);
        }
      });
    },
    async placeVideoCall() {
      this.showVideoWindow = true;
      this.callPlaced = true;
      this.callPartner = this.recipient_user_name;
      await this.getMediaPermission();

      this.log(
        `Placing video call with time limit: ${this.time_limit} seconds to user ${this.recipient_user_id} ${this.recipient_user_name}`
      );

      this.videoCallParams.peer = new Peer({
        initiator: true,
        trickle: false,
        stream: this.videoCallParams.stream,
        config: {
          iceServers: [
            {
              urls: this.turn_url,
              username: this.turn_username,
              credential: this.turn_credential,
            },
          ],
        },
      });

      this.videoCallParams.peer.on("signal", (data) => {
        axios
          .post("/video/call-user", {
            user_to_call: this.recipient_user_id,
            signal_data: data,
            from: this.auth_user_id,
          })
          .then((res) => {
            this.log("Signal sent to server waiting for call acceptance");
            console.log("Signal sent to server", res);
          })
          .catch((error) => {
            this.log("Error sending signal to server: " + error.message);
            console.error(error);
          });
      });

      this.videoCallParams.peer.on("stream", (stream) => {
        if (this.$refs.partnerVideo) {
          this.$refs.partnerVideo.srcObject = stream;
          this.startPingTest();
        }
      });

      this.videoCallParams.peer.on("connect", () => {
        this.log("Peer connected");
        console.log("Peer connected");
        this.startPingTest();
      });

      this.videoCallParams.peer.on("error", (err) => {
        this.log("Peer connection error: " + err.message);
        console.error("Peer connection error", err);
      });

      this.videoCallParams.peer.on("close", () => {
        this.log("Call closed by caller");
        console.log("Call closed by caller");
      });

      this.videoCallParams.channel.listen("StartVideoChat", ({ data }) => {
        if (data.type === "callAccepted") {
          const updatedSignal = { ...data.signal, sdp: `${data.signal.sdp}\n` };
          this.videoCallParams.callAccepted = true;
          this.videoCallParams.peer.signal(updatedSignal);
        }
      });

      this.startTimer(); // Start the timer after setting up the call
    },
    async acceptCall() {
      this.showVideoWindow = true;
      this.callPlaced = true;
      this.videoCallParams.callAccepted = true;
      this.videoCallParams.receivingCall = false;
      this.callPartner = this.recipient_user_name;
      await this.getMediaPermission();

      this.log(
        `Accepting video call with time limit: ${this.time_limit} seconds`
      );

      this.videoCallParams.peer = new Peer({
        initiator: false,
        trickle: false,
        stream: this.videoCallParams.stream,
        config: {
          iceServers: [
            {
              urls: this.turn_url,
              username: this.turn_username,
              credential: this.turn_credential,
            },
          ],
        },
      });

      this.videoCallParams.peer.on("signal", (data) => {
        axios
          .post("/video/call-accepted", {
            signal_data: data,
            to: this.videoCallParams.caller,
          })
          .then((res) => {
            this.log("Signal sent to server");
            console.log("Signal sent to server", res);
          })
          .catch((error) => {
            this.log("Error sending signal to server: " + error.message);
            console.error(error);
          });
      });

      this.videoCallParams.peer.on("stream", (stream) => {
        if (this.$refs.partnerVideo) {
          this.$refs.partnerVideo.srcObject = stream;
        }
      });

      this.videoCallParams.peer.on("connect", () => {
        this.log("Peer connected");
        console.log("Peer connected");
      });

      this.videoCallParams.peer.on("error", (err) => {
        this.log("Peer connection error: " + err.message);
        console.error("Peer connection error", err);
      });

      this.videoCallParams.peer.on("close", () => {
        this.log("Call closed by recipient");
        console.log("Call closed by recipient");
      });

      this.videoCallParams.peer.signal(this.videoCallParams.callerSignal);

      this.startTimer(); // Start the timer after setting up the call
    },
    declineCall() {
      this.videoCallParams.receivingCall = false;
      axios.post("/video/decline-call", {
        to: this.videoCallParams.caller,
      });
      this.log("Declined the call");
      console.log("Declined the call");
    },
    startTimer() {
      this.timeLeft = this.time_limit;
      this.timerInterval = setInterval(() => {
        if (this.timeLeft > 0) {
          this.timeLeft -= 1;
        } else {
          this.endCall();
        }
      }, 1000);
    },
    formatTime(seconds) {
      const minutes = Math.floor(seconds / 60);
      const secs = seconds % 60;
      return `${minutes}:${secs < 10 ? "0" : ""}${secs}`;
    },
    endCall() {
      if (this.videoCallParams.peer) {
        this.videoCallParams.peer.destroy();
      }
      clearInterval(this.timerInterval);
      this.showVideoWindow = false;
      this.callPlaced = false;
      this.videoCallParams.callAccepted = false;
      this.videoCallParams.receivingCall = false;
      this.callPartner = null;
      this.videoCallParams.stream.getTracks().forEach((track) => track.stop());
      this.videoCallParams.stream = null;
      this.playEndCallSound();
      this.log("Call ended");
      console.log("Call ended");
    },
    toggleMuteAudio() {
      this.mutedAudio = !this.mutedAudio;
      this.videoCallParams.stream.getAudioTracks().forEach((track) => {
        track.enabled = !this.mutedAudio;
      });
      this.log(`Audio ${this.mutedAudio ? "muted" : "unmuted"}`);
      console.log(`Audio ${this.mutedAudio ? "muted" : "unmuted"}`);
    },
    toggleMuteVideo() {
      this.mutedVideo = !this.mutedVideo;
      this.videoCallParams.stream.getVideoTracks().forEach((track) => {
        track.enabled = !this.mutedVideo;
      });
      this.log(`Video ${this.mutedVideo ? "hidden" : "shown"}`);
      console.log(`Video ${this.mutedVideo ? "hidden" : "shown"}`);
    },
    toggleCameraArea() {
      this.isFocusMyself = !this.isFocusMyself;
    },
    playIncomingCallSound() {
      const audio = new Audio("/sounds/incoming-call.mp3");
      audio.play().catch((error) => {
        console.error("Error playing sound:", error);
      });
      this.log("Playing incoming call sound");
      console.log("Playing incoming call sound");
    },
    playEndCallSound() {
      const audio = new Audio("/sounds/call-ended.mp3");
      audio.play().catch((error) => {
        console.error("Error playing sound:", error);
      });
      console.log("Playing incoming call sound");
    },
    startPingTest() {
      this.pingInterval = setInterval(() => {
        const start = Date.now();
        this.videoCallParams.peer.send("ping");
        this.videoCallParams.peer.on("data", (data) => {
          if (data.toString() === "ping") {
            const ping = Date.now() - start;
            this.log(`Ping speed: ${ping} ms`);
            console.log(`Ping speed: ${ping} ms`);
          }
        });
      }, 10000); // Ping every 10 seconds
    },
    log(message) {
      this.logs.push(message);
      console.log("Log message:", message);
    },
  },
};
</script>

<style scoped>
#video-row {
  width: 700px;
  max-width: 90vw;
}

#incoming-call-card {
  border: 1px solid #0acf83;
}

.video-container {
  width: 700px;
  height: 500px;
  max-width: 90vw;
  max-height: 50vh;
  margin: 0 auto;
  border: 1px solid #0acf83;
  position: relative;
  box-shadow: 1px 1px 11px #9e9e9e;
  background-color: #fff;
}

.video-container .user-video {
  width: 30%;
  position: absolute;
  left: 10px;
  bottom: 10px;
  border: 1px solid #fff;
  border-radius: 6px;
  z-index: 2;
}

.video-container .partner-video {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  top: 0;
  z-index: 1;
  margin: 0;
  padding: 0;
}

.video-container .action-btns {
  position: absolute;
  bottom: 20px;
  left: 50%;
  margin-left: -50px;
  z-index: 3;
  display: flex;
  flex-direction: row;
}

.logs {
  margin-top: 20px;
}

.logs ul {
  list-style-type: none;
  padding: 0;
}

.logs li {
  margin-bottom: 5px;
  font-size: 14px;
  background-color: #f0f0f0;
  padding: 5px;
  border-radius: 5px;
}

/* Mobile Styles */
@media only screen and (max-width: 768px) {
  .video-container {
    height: 50vh;
  }
}
</style>
