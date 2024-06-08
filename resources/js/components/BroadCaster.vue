<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <button class="btn btn-success" @click="startCall">Start Call</button>
        <video autoplay ref="localVideo"></video>
        <video autoplay ref="remoteVideo"></video>
      </div>
    </div>
  </div>
</template>

<script>
import Peer from "simple-peer";
import { getPermissions } from "../helper";

export default {
  name: "VideoCall",
  props: [
    "auth_user_id",
    "callee_id",
    "turn_url",
    "turn_username",
    "turn_credential",
  ],
  data() {
    return {
      callActive: false,
      localStream: null,
      peer: null,
    };
  },
  methods: {
    async startCall() {
      this.localStream = await getPermissions();
      this.$refs.localVideo.srcObject = this.localStream;
      this.createPeer(true);
    },
    createPeer(initiator) {
      console.log("callee_id", this.callee_id);
      this.peer = new Peer({
        initiator,
        trickle: false,
        stream: this.localStream,
        config: {
          iceServers: [
            {
              urls: "stun:stun.stunprotocol.org",
            },
            {
              urls: this.turn_url,
              username: this.turn_username,
              credential: this.turn_credential,
            },
          ],
        },
      });

      console.log("peer", this.peer);

      this.peer.on("signal", (data) => {
        this.signalCallback(data);
      });

      this.peer.on("stream", (stream) => {
        this.$refs.remoteVideo.srcObject = stream;
      });

      this.peer.on("connect", () => {
        console.log("Peer connected");
        this.callActive = true;
      });

      this.peer.on("close", () => {
        console.log("Peer closed");
        this.callActive = false;
      });

      this.peer.on("error", (err) => {
        console.log("Peer error:", err);
        this.callActive = false;
      });
    },
    signalCallback(offer) {
      axios
        .post("/call-offer", {
          caller: this.auth_user_id,
          callee: this.callee_id,
          offer,
        })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    handleAnswer(answer) {
      this.peer.signal(answer);
    },
    listenForCall() {
      console.log("inside listen call");
      window.Echo.private(`call-channel.${this.auth_user_id}`)
        .listen("CallOffer", ({ data }) => {
          console.log("inside call offer");
          this.createPeer(false);
          this.peer.signal(data.offer);
        })
        .listen("CallAnswer", ({ data }) => {
          this.handleAnswer(data.answer);
        });
    },
  },
  mounted() {
    this.listenForCall();
  },
};
</script>

<style scoped></style>
