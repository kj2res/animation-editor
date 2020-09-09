<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
      <v-container>
        <h2>Controllers</h2>
        <v-row>
            <v-col>
                <form>
                    <v-select
                        v-model="select"
                        :items="items"
                        :error-messages="selectErrors"
                        label="Animation Type"
                        required
                        @change="$v.select.$touch()"
                        @blur="$v.select.$touch()"
                    ></v-select>

                    <v-text-field
                        v-model="delay"
                        :error-messages="delayErrors"
                        label="Delay Animation Start (ms)"
                        required
                        @input="$v.delay.$touch()"
                        @blur="$v.delay.$touch()"
                    ></v-text-field>

                    <v-text-field
                        v-model="speed"
                        :error-messages="speedErrors"
                        label="Animation Speed (ms)"
                        required
                        @input="$v.speed.$touch()"
                        @blur="$v.speed.$touch()"
                    ></v-text-field>

                    <v-btn class="mr-4" @click="preview">Preview</v-btn>
                    <v-btn @click="clear">Save</v-btn>
                </form>
            </v-col>
        </v-row>
      </v-container>

    </v-navigation-drawer>

    <v-app-bar
      app
      color="indigo"
      dark
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>Animation Demo</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <Content v-bind:speed="speed" v-bind:delay="delay" v-bind:animation="select" v-bind:animate="animate"></Content>
    </v-main>
    <v-footer
      color="indigo"
      app
    >
      <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { numeric, required } from 'vuelidate/lib/validators'
  import Content from './components/Content';

  export default {
    mixins: [validationMixin],

    components: {
      Content
    },

    validations: {
      select: { required },
      speed: { numeric },
      delay: { numeric }
    },

    data: () => ({
        animate: false,
        drawer: null,
        speed: 0,
        delay: 0,
        select: null,
        items: [
        'Fade In',
        'Fade Out',
        'Slide-in from Left',
        ],
    }),

    computed: {
        selectErrors () {
            const errors = []
            if (!this.$v.select.$dirty) return errors
            !this.$v.select.required && errors.push('Animation type is required')
            return errors
        },
        delayErrors () {
            const errors = []
            if (!this.$v.delay.$dirty) return errors
            !this.$v.delay.numeric && errors.push('Accepts only numerics.')
            return errors
        },
        speedErrors () {
            const errors = []
            if (!this.$v.speed.$dirty) return errors
            !this.$v.speed.numeric && errors.push('Accepts only numerics.')
            return errors
        },
    },

    methods: {
      preview () {
        this.animate = true
        this.$v.$touch()
      },
      clear () {
        this.$v.$reset()
        this.select = null
      },
    },
  }
</script>
