<template>
  <div>
    <div class="container">
      <!-- Video Call Icon and Video Window -->
      <div class="row mt-5" id="video-row" v-if="showVideoWindow">
        <div class="col-12 video-container">
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
            <button
              type="button"
              class="btn btn-danger"
              data-dismiss="modal"
              @click="declineCall"
            >
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
  </div>
</template>
<script>
import Peer from "simple-peer";
import { getPermissions } from "../helper";
export default {
  props: [
    "authUserId", // Current user's ID
    "recipientUserId", // ID of the user to call
    "recipientUserName", // Name of the user to call
    "turn_url",
    "turn_username",
    "turn_credential",
  ],
  data() {
    return {
      isFocusMyself: true,
      showVideoWindow: false,
      callPlaced: false,
      callPartner: null,
      mutedAudio: false,
      mutedVideo: false,
      videoCallParams: {
        stream: null,
        receivingCall: false,
        caller: null,
        callerSignal: null,
        callAccepted: false,
        channel: null,
        peer: null,
      },
    };
  },
  mounted() {
    this.initializeChannel(); // Initializes Laravel Echo
    this.initializeCallListeners(); // Subscribes to video presence channel and listens to video events
  },
  computed: {
    incomingCallDialog() {
      return (
        this.videoCallParams.receivingCall &&
        this.videoCallParams.caller !== this.authUserId
      );
    },
    callerDetails() {
      return {
        id: this.videoCallParams.caller,
        name: this.recipientUserName,
      };
    },
  },
  methods: {
    initializeChannel() {
      this.videoCallParams.channel = window.Echo.join("presence-video-channel");
      console.log(`User ${this.authUserId} joined the presence-video-channel.`);
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

      // Listen to incoming call
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
      this.callPartner = this.recipientUserName;
      await this.getMediaPermission();

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
            user_to_call: this.recipientUserId,
            signal_data: data,
            from: this.authUserId,
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
          const updatedSignal = {
            ...data.signal,
            sdp: `${data.signal.sdp}\n`,
          };
          this.videoCallParams.callAccepted = true;
          this.videoCallParams.peer.signal(updatedSignal);
        }
      });
    },
    async acceptCall() {
      this.showVideoWindow = true;
      this.callPlaced = true;
      this.videoCallParams.callAccepted = true;
      await this.getMediaPermission();

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
    endCall() {
      this.videoCallParams.callAccepted = false;
      this.callPlaced = false;
      this.callPartner = null;
      this.showVideoWindow = false;

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
      const audio = new Audio("/sounds/incoming_call.mp3");
      audio.play();
    },
    playCallEndSound() {
      const audio = new Audio("/sounds/call_end.mp3");
      audio.play();
    },
  },
};
</script>
<style scoped>
.video-container {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.user-video,
.partner-video {
  width: 100%;
  max-width: 600px;
  border: 1px solid #ddd;
}

.user-video {
  position: relative;
  z-index: 2;
}

.partner-video {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1;
  opacity: 0.8;
}

.action-btns {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  justify-content: center;
}
</style>
