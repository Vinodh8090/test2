<template>
  <div>
    <h1>WebRTC Video Streaming</h1>
    <div>
      <button @click="start">Start</button>
      <button @click="generateOffer">Generate Offer</button>
      <button @click="setAnswer">Set Answer</button>
    </div>
    <div>
      <video ref="localVideo" autoplay></video>
      <video ref="remoteVideo" autoplay></video>
    </div>
    <div>
      <h2>Offer</h2>
      <textarea v-model="offer"></textarea>
      <h2>Answer</h2>
      <textarea v-model="answer"></textarea>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      localStream: null,
      localPeerConnection: null,
      remotePeerConnection: null,
      offer: "",
      answer: "",
    };
  },
  methods: {
    async start() {
      console.log("dummmy");
      try {
        this.localStream = await navigator.mediaDevices.getUserMedia({
          video: true,
          audio: true,
        });
        this.$refs.localVideo.srcObject = this.localStream;
      } catch (error) {
        console.error("Error accessing media devices.", error);
      }
    },
    async generateOffer() {
      this.localPeerConnection = new RTCPeerConnection();
      this.localPeerConnection.addStream(this.localStream);

      this.localPeerConnection.onicecandidate = (event) => {
        if (event.candidate) {
          console.log("Local ICE candidate:", event.candidate);
        }
      };

      this.remotePeerConnection = new RTCPeerConnection();
      this.remotePeerConnection.onicecandidate = (event) => {
        if (event.candidate) {
          this.localPeerConnection.addIceCandidate(
            new RTCIceCandidate(event.candidate)
          );
        }
      };

      this.remotePeerConnection.onaddstream = (event) => {
        this.$refs.remoteVideo.srcObject = event.stream;
      };

      const offer = await this.localPeerConnection.createOffer();
      await this.localPeerConnection.setLocalDescription(offer);
      this.offer = JSON.stringify(this.localPeerConnection.localDescription);

      this.remotePeerConnection.setRemoteDescription(
        this.localPeerConnection.localDescription
      );
      const answer = await this.remotePeerConnection.createAnswer();
      await this.remotePeerConnection.setLocalDescription(answer);
      this.answer = JSON.stringify(this.remotePeerConnection.localDescription);

      this.localPeerConnection.setRemoteDescription(
        this.remotePeerConnection.localDescription
      );
    },
    async setAnswer() {
      const answer = JSON.parse(this.answer);
      await this.localPeerConnection.setRemoteDescription(answer);
    },
  },
};
</script>

<style scoped>
video {
  width: 400px;
  height: 300px;
  margin: 10px;
  border: 1px solid black;
}
textarea {
  width: 400px;
  height: 100px;
}
</style>
