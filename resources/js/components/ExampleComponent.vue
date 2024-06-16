<template>
  <div>
    <h1>WebRTC Video Streaming</h1>
    <div>
      <button @click="start">Start</button>
      <button @click="generateOffer">Generate Offer</button>
      <button @click="setRemoteOffer">Set Remote Offer</button>
      <button @click="generateAnswer">Generate Answer</button>
      <button @click="setAnswer">Set Answer</button>
    </div>
    <div>
      <video ref="localVideo" autoplay playsinline></video>
      <video ref="remoteVideo" autoplay playsinline></video>
    </div>
    <div>
      <h2>Offer</h2>
      <textarea v-model="offer"></textarea>
      <h2>Remote Offer</h2>
      <textarea v-model="remoteOffer"></textarea>
      <h2>Answer</h2>
      <textarea v-model="answer"></textarea>
    </div>
  </div>
</template>

<script>
export default {
  name: "VideoChat",
  data() {
    return {
      localStream: null,
      localPeerConnection: null,
      remotePeerConnection: null,
      offer: "",
      remoteOffer: "",
      answer: "",
      localIceCandidates: [],
      remoteIceCandidates: [],
    };
  },
  methods: {
    async start() {
      console.log("Starting video stream...");
      try {
        this.localStream = await navigator.mediaDevices.getUserMedia({
          video: true,
          audio: true,
        });
        this.$refs.localVideo.srcObject = this.localStream;
        console.log("Local stream started.");
      } catch (error) {
        console.error("Error accessing media devices.", error);
      }
    },
    async generateOffer() {
      console.log("Generating offer...");
      try {
        this.localPeerConnection = new RTCPeerConnection();

        // Add the local stream tracks to the peer connection
        this.localStream.getTracks().forEach((track) => {
          this.localPeerConnection.addTrack(track, this.localStream);
        });

        this.localPeerConnection.onicecandidate = (event) => {
          if (event.candidate) {
            console.log("Local ICE candidate:", event.candidate);
            if (this.remotePeerConnection) {
              this.remotePeerConnection.addIceCandidate(
                new RTCIceCandidate(event.candidate)
              );
            } else {
              this.localIceCandidates.push(event.candidate);
            }
          }
        };

        const offer = await this.localPeerConnection.createOffer();
        await this.localPeerConnection.setLocalDescription(offer);
        this.offer = JSON.stringify(this.localPeerConnection.localDescription);
        console.log("Offer generated:", this.offer);
      } catch (error) {
        console.error("Error generating offer:", error);
      }
    },
    async setRemoteOffer() {
      console.log("Setting remote offer...");
      try {
        this.remotePeerConnection = new RTCPeerConnection();

        this.remotePeerConnection.onicecandidate = (event) => {
          if (event.candidate) {
            console.log("Remote ICE candidate:", event.candidate);
            if (this.localPeerConnection) {
              this.localPeerConnection.addIceCandidate(
                new RTCIceCandidate(event.candidate)
              );
            } else {
              this.remoteIceCandidates.push(event.candidate);
            }
          }
        };

        this.remotePeerConnection.ontrack = (event) => {
          this.$refs.remoteVideo.srcObject = event.streams[0];
          console.log("Remote stream added:", event.streams[0]);
        };

        const remoteOffer = JSON.parse(this.remoteOffer);
        await this.remotePeerConnection.setRemoteDescription(remoteOffer);

        // Add any queued ICE candidates
        this.localIceCandidates.forEach((candidate) =>
          this.remotePeerConnection.addIceCandidate(
            new RTCIceCandidate(candidate)
          )
        );
        console.log("Remote offer set.");
      } catch (error) {
        console.error("Error setting remote offer:", error);
      }
    },
    async generateAnswer() {
      console.log("Generating answer...");
      try {
        const answer = await this.remotePeerConnection.createAnswer();
        await this.remotePeerConnection.setLocalDescription(answer);
        this.answer = JSON.stringify(
          this.remotePeerConnection.localDescription
        );
        console.log("Answer generated:", this.answer);
      } catch (error) {
        console.error("Error generating answer:", error);
      }
    },
    async setAnswer() {
      console.log("Setting answer...");
      try {
        const answer = JSON.parse(this.answer);
        await this.localPeerConnection.setRemoteDescription(answer);

        // Add any queued ICE candidates
        this.remoteIceCandidates.forEach((candidate) =>
          this.localPeerConnection.addIceCandidate(
            new RTCIceCandidate(candidate)
          )
        );
        console.log("Answer set.");
      } catch (error) {
        console.error("Error setting answer:", error);
      }
    },
  },
  mounted() {
    // Request media permissions and display local video stream for both instances
    this.start();
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
