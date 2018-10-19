<template>
  <img class="avatar1em" v-bind:src="user && user.attributes.fotografia ? user.attributes.fotografia.url : '/images/slightly-smiling-face_1f642.png'">
</template>

<script>
  export default {
      props: {
          'user': Object
      }
  }
</script>
