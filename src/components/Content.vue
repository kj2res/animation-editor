<template>
  <v-container
    class="fill-height"
    fluid
  >
    <v-row
      align="center"
      justify="center"
    >
      <v-col class="text-center">
        <transition name="fade">
            <p v-if="animate">TEXT HERE</p>
        </transition>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: ['animation', 'speed', 'delay', 'animate']
  }
</script>

<style>

.fade-enter-active, .fade-leave-active {
  transition: opacity .8s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>