<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      right
    >
      <div class="pa-5">
        <form>
          <v-select
              v-model="animation"
              :items="animationTypes"
              label="Animation Type"
          ></v-select>

          <v-text-field
              v-model="delay"
              :error-messages="delayErrors"
              label="Delay Animation Start (ms)"
              @input="$v.delay.$touch()"
              @blur="$v.delay.$touch()"
          ></v-text-field>

          <v-text-field
              v-model="duration"
              :error-messages="durationErrors"
              label="Animation Speed (ms)"
              @input="$v.duration.$touch()"
              @blur="$v.duration.$touch()"
          ></v-text-field>

          <v-btn class="mr-4" @click="preview">Preview</v-btn>
          <v-btn>Save</v-btn>
        </form>
      </div>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="cyan"
      dark
    >
      <v-toolbar-title>Animation Editor</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center">
            <p v-if="show" class="display-4" @click="showController">
              Example Text
            </p>
          </v-col>
        </v-row>
      </v-container>
    </v-main>

    <v-footer
      color="cyan"
      app
    >
      <v-spacer></v-spacer>

      <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { numeric } from 'vuelidate/lib/validators'

  import Velocity from 'velocity-animate';
  import 'velocity-animate/velocity.ui';

  export default {
    mixins: [validationMixin],
    validations: {
      duration: { numeric },
      delay: { numeric }
    },
    props: {

    },
    data: () => ({
      show: true,
      drawer: false,
      duration: 1000,
      delay: 100,
      animationTypes: [
        'Fade In',
        'Fade Out',
        'Slide-in from Left'
      ],
      animation: '',
      currentEl: null
    }),
    computed: {
      animationType: function() {
        if (this.animation == 'Fade In') {
          return 'transition.fadeIn';
        } else if(this.animation == 'Fade Out') {
          return 'transition.fadeOut';
        } else if(this.animation == 'Slide-in from Left') {
          return 'transition.slideLeftIn';
        } else {
          return {opacity: 1};
        }
      },
      delayErrors () {
          const errors = []
          if (!this.$v.delay.$dirty) return errors
          !this.$v.delay.numeric && errors.push('Accepts only numerics.')
          return errors
      },
      durationErrors () {
          const errors = []
          if (!this.$v.duration.$dirty) return errors
          !this.$v.duration.numeric && errors.push('Accepts only numerics.')
          return errors
      }
    },
    methods: {
      showController: function (event) {
        this.currentEl = event.target;
        this.drawer = !this.drawer;
      },
      preview: function () {
        console.log('starting animation')
        //var vm = this
        Velocity(this.currentEl,
          this.animationType,
          {
            duration: this.duration,
            delay: this.delay
          }
        )

        if (this.animationType == 'transition.fadeOut') {
          Velocity(this.currentEl, { opacity: 1 }, { display: "block" });
        }
      }
    }
  }
</script>

<style>
</style>
