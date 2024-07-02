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
        <li v-for="log in logs" :key="log">{{ log }}</li>
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
    console.log("Time limit prop:", this.time_limit);
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
      console.log(
        `User ${this.auth_user_id} joined the presence-video-channel.`
      );
      console.log(
        `Placing video call with time limit: ${this.time_limit} seconds`
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
        console.log("Users currently in the channel:", users);
      });

      this.videoCallParams.channel.joining((user) => {
        console.log("User joined the channel:", user);
      });

      this.videoCallParams.channel.leaving((user) => {
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
        }
      });
    },
    async placeVideoCall() {
      this.showVideoWindow = true;
      this.callPlaced = true;
      this.callPartner = this.recipient_user_name;
      await this.getMediaPermission();

      console.log(
        `Placing video call with time limit: ${this.time_limit} seconds`
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
          .then((res) => console.log("Signal sent to server", res))
          .catch((error) => {
            console.error(error);
          });
      });

      this.videoCallParams.peer.on("stream", (stream) => {
        if (this.$refs.partnerVideo) {
          this.$refs.partnerVideo.srcObject = stream;
        }
      });

      this.videoCallParams.peer.on("connect", () => {
        console.log("Peer connected");
      });

      this.videoCallParams.peer.on("error", (err) => {
        console.error("Peer connection error", err);
      });

      this.videoCallParams.peer.on("close", () => {
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
      await this.getMediaPermission();

      console.log(
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

      this.videoCallParams.receivingCall = false;

      this.videoCallParams.peer.on("signal", (data) => {
        axios
          .post("/video/accept-call", {
            signal: data,
            to: this.videoCallParams.caller,
          })
          .then(() => {})
          .catch((error) => {
            console.error(error);
          });
      });

      this.videoCallParams.peer.on("stream", (stream) => {
        this.$refs.partnerVideo.srcObject = stream;
      });

      this.videoCallParams.peer.on("connect", () => {
        console.log("Peer connected");
      });

      this.videoCallParams.peer.on("error", (err) => {
        console.error("Peer connection error", err);
      });

      this.videoCallParams.peer.on("close", () => {
        console.log("Call closed by accepter");
      });

      this.videoCallParams.peer.signal(this.videoCallParams.callerSignal);

      this.startTimer(); // Start the timer after accepting the call
    },
    startTimer() {
      if (this.time_limit <= 0) {
        console.error("Invalid time limit. Ending call immediately.");
        this.endCall();
        return;
      }

      this.timeLeft = this.time_limit;
      console.log(`Timer started with ${this.timeLeft} seconds`);
      this.timerInterval = setInterval(() => {
        if (this.timeLeft > 0) {
          this.timeLeft -= 1;
          console.log(`Time left: ${this.timeLeft} seconds`);
        } else {
          console.log("Time is up. Ending call.");
          this.endCall();
        }
      }, 1000);
    },
    formatTime(seconds) {
      const minutes = Math.floor(seconds / 60);
      const secs = seconds % 60;
      return `${minutes}:${secs < 10 ? "0" : ""}${secs}`;
    },
    toggleCameraArea() {
      if (this.videoCallParams.callAccepted) {
        this.isFocusMyself = !this.isFocusMyself;
      }
    },
    declineCall() {
      this.videoCallParams.receivingCall = false;
    },
    toggleMuteAudio() {
      if (this.$refs.userVideo && this.$refs.userVideo.srcObject) {
        const audioTracks = this.$refs.userVideo.srcObject.getAudioTracks();
        if (audioTracks.length > 0) {
          audioTracks[0].enabled = !this.mutedAudio;
          this.mutedAudio = !this.mutedAudio;
        }
      }
    },
    toggleMuteVideo() {
      if (this.$refs.userVideo && this.$refs.userVideo.srcObject) {
        const videoTracks = this.$refs.userVideo.srcObject.getVideoTracks();
        if (videoTracks.length > 0) {
          videoTracks[0].enabled = !this.mutedVideo;
          this.mutedVideo = !this.mutedVideo;
        }
      }
    },
    log(message) {
      this.logs.push(message);
    },
    logWebRTCStats() {
      const peerConnection = this.videoCallParams.peer;

      if (peerConnection) {
        peerConnection
          .getStats(null)
          .then((stats) => {
            stats.forEach((report) => {
              // Example of logging ping time (you need to find the correct metric)
              if (
                report.type === "candidate-pair" &&
                report.remoteCandidateType === "relay"
              ) {
                this.log(`Ping speed: ${report.currentRoundTripTime}ms`);
              }
              // Log other relevant WebRTC stats
              this.log(`WebRTC Stats: ${JSON.stringify(report)}`);
            });
          })
          .catch((error) => {
            console.error("Error getting WebRTC stats:", error);
          });
      } else {
        this.log("Peer connection not available.");
      }
    },
    endCall() {
      this.videoCallParams.callAccepted = false;
      this.callPlaced = false;
      this.callPartner = null;
      this.showVideoWindow = false;
      this.timeLeft = 0;
      clearInterval(this.timerInterval);

      if (this.videoCallParams.stream) {
        this.videoCallParams.stream.getTracks().forEach((track) => {
          track.stop();
        });
      }

      if (this.videoCallParams.peer) {
        this.videoCallParams.peer.destroy();
      }

      this.videoCallParams.peer = null;

      this.playCallEndSound();
    },
    playIncomingCallSound() {
      const audio = new Audio("../audio/incoming-call.mp3");
      audio.play();
    },
    playCallEndSound() {
      const audio = new Audio("../audio/call-end.mp3");
      audio.play();
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

/* Mobile Styles */
@media only screen and (max-width: 768px) {
  .video-container {
    height: 50vh;
  }
}
</style>
