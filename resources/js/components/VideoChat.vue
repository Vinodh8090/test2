<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="btn-group" role="group">
            <button
              type="button"
              class="btn btn-primary mr-2"
              v-for="user in allusers"
              :key="user.id"
              @click="placeVideoCall(user.id, user.name)"
            >
              Call {{ user.name }}
              <span class="badge badge-light">{{
                getUserOnlineStatus(user.id)
              }}</span>
            </button>
          </div>
        </div>
      </div>
      <!--Placing Video Call-->
      <div class="row mt-5" id="video-row">
        <div class="col-12 video-container" v-if="callPlaced">
          <video
            ref="userVideo"
            muted
            playsinline
            autoplay
            class="cursor-pointer"
            :class="isFocusMyself === true ? 'user-video' : 'partner-video'"
            @click="toggleCameraArea"
          />
          <video
            ref="partnerVideo"
            playsinline
            autoplay
            class="cursor-pointer"
            :class="isFocusMyself === true ? 'partner-video' : 'user-video'"
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
              {{ mutedVideo ? "ShowVideo" : "HideVideo" }}
            </button>
            <button type="button" class="btn btn-danger" @click="endCall">
              EndCall
            </button>
          </div>
        </div>
      </div>
      <!-- End of Placing Video Call  -->

      <!-- Incoming Call  -->
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
      <!-- End of Incoming Call  -->
    </div>
  </div>
</template>

<script>
import Peer from "simple-peer";
import { getPermissions } from "../helper";
export default {
  props: [
    "allusers",
    "authuserid",
    "turn_url",
    "turn_username",
    "turn_credential",
  ],
  data() {
    return {
      isFocusMyself: true,
      callPlaced: false,
      callPartner: null,
      mutedAudio: false,
      mutedVideo: false,
      videoCallParams: {
        users: [],
        stream: null,
        receivingCall: false,
        caller: null,
        callerSignal: null,
        callAccepted: false,
        channel: null,
        peer1: null,
        peer2: null,
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
        this.videoCallParams.caller !== this.authuserid
      );
    },
    callerDetails() {
      if (
        this.videoCallParams.caller &&
        this.videoCallParams.caller !== this.authuserid
      ) {
        const incomingCaller = this.allusers.find(
          (user) => user.id === this.videoCallParams.caller
        );
        return incomingCaller
          ? { id: this.videoCallParams.caller, name: incomingCaller.name }
          : null;
      }
      return null;
    },
  },
  methods: {
    initializeChannel() {
      this.videoCallParams.channel = window.Echo.join("presence-video-channel");
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
        this.videoCallParams.users = users;
      });

      this.videoCallParams.channel.joining((user) => {
        if (!this.videoCallParams.users.some((data) => data.id === user.id)) {
          this.videoCallParams.users.push(user);
        }
      });

      this.videoCallParams.channel.leaving((user) => {
        const leavingUserIndex = this.videoCallParams.users.findIndex(
          (data) => data.id === user.id
        );
        if (leavingUserIndex >= 0) {
          this.videoCallParams.users.splice(leavingUserIndex, 1);
        }
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
        }
      });
    },
    async placeVideoCall(id, name) {
      this.callPlaced = true;
      this.callPartner = name;
      await this.getMediaPermission();
      this.videoCallParams.peer1 = new Peer({
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

      this.videoCallParams.peer1.on("signal", (data) => {
        axios
          .post("/video/call-user", {
            user_to_call: id,
            signal_data: data,
            from: this.authuserid,
          })
          .then((res) => console.log("res", res, this.authuserid))
          .catch((error) => {
            console.error(error);
          });
      });

      this.videoCallParams.peer1.on("stream", (stream) => {
        if (this.$refs.partnerVideo) {
          this.$refs.partnerVideo.srcObject = stream;
        }
      });

      this.videoCallParams.peer1.on("connect", () => {
        console.log("peer connected");
      });

      this.videoCallParams.peer1.on("error", (err) => {
        console.error("peer connection error", err);
      });

      this.videoCallParams.peer1.on("close", () => {
        console.log("call closed caller");
      });

      this.videoCallParams.channel.listen("StartVideoChat", ({ data }) => {
        if (data.type === "callAccepted") {
          const updatedSignal = {
            ...data.signal,
            sdp: `${data.signal.sdp}\n`,
          };
          this.videoCallParams.callAccepted = true;
          this.videoCallParams.peer1.signal(updatedSignal);
        }
      });
    },
    async acceptCall() {
      this.callPlaced = true;
      this.videoCallParams.callAccepted = true;
      await this.getMediaPermission();
      this.videoCallParams.peer2 = new Peer({
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

      this.videoCallParams.peer2.on("signal", (data) => {
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

      this.videoCallParams.peer2.on("stream", (stream) => {
        this.$refs.partnerVideo.srcObject = stream;
      });

      this.videoCallParams.peer2.on("connect", () => {
        console.log("peer2 connected");
      });

      this.videoCallParams.peer2.on("error", (err) => {
        console.error("err from peer2", err);
      });

      this.videoCallParams.peer2.on("close", () => {
        console.log("call closed accepter");
      });

      this.videoCallParams.peer2.signal(this.videoCallParams.callerSignal);
    },
    toggleCameraArea() {
      if (this.videoCallParams.callAccepted) {
        this.isFocusMyself = !this.isFocusMyself;
      }
    },
    getUserOnlineStatus(id) {
      return this.videoCallParams.users.some((data) => data.id === id)
        ? "Online"
        : "Offline";
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
        } else {
          console.warn("No audio tracks found");
        }
      } else {
        console.warn("User video stream is not available");
      }
    },
    toggleMuteVideo() {
      if (this.$refs.userVideo && this.$refs.userVideo.srcObject) {
        const videoTracks = this.$refs.userVideo.srcObject.getVideoTracks();
        if (videoTracks.length > 0) {
          videoTracks[0].enabled = !this.mutedVideo;
          this.mutedVideo = !this.mutedVideo;
        } else {
          console.warn("No video tracks found");
        }
      } else {
        console.warn("User video stream is not available");
      }
    },
    stopStreamedVideo(videoElem) {
      if (videoElem && videoElem.srcObject) {
        const stream = videoElem.srcObject;
        const tracks = stream.getTracks();
        tracks.forEach((track) => {
          track.stop();
        });
        videoElem.srcObject = null;
      }
    },
    endCall() {
      if (!this.mutedVideo) this.toggleMuteVideo();
      if (!this.mutedAudio) this.toggleMuteAudio();

      if (this.$refs.userVideo) {
        this.stopStreamedVideo(this.$refs.userVideo);
      }

      if (this.authuserid === this.videoCallParams.caller) {
        if (this.videoCallParams.peer1) {
          this.videoCallParams.peer1.destroy();
        } else {
          console.warn("peer1 is null when trying to end call");
        }
      } else {
        if (this.videoCallParams.peer2) {
          this.videoCallParams.peer2.destroy();
        } else {
          console.warn("peer2 is null when trying to end call");
        }
      }

      if (
        this.videoCallParams.channel &&
        this.videoCallParams.channel.pusher &&
        this.videoCallParams.channel.pusher.channels
      ) {
        this.videoCallParams.channel.pusher.channels.channels[
          "presence-video-channel"
        ].disconnect();
      } else {
        console.warn("Unable to disconnect from presence-video-channel");
      }

      setTimeout(() => {
        this.callPlaced = false;
      }, 3000);
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

/* Mobiel Styles */
@media only screen and (max-width: 768px) {
  .video-container {
    height: 50vh;
  }
}
</style>
