<template>
  <authentication-card>
    <template #logo>
      <authentication-card-logo />
    </template>

    <jet-validation-errors class="mb-4" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <!-- Login form -->
    <form @submit.prevent="submit">
      <div>
        <jet-label for="email" value="Email" />
        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
      </div>

      <div class="mt-4">
        <jet-label for="password" value="Contraseña" />
        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <jet-checkbox name="remember" v-model:checked="form.remember" />
          <span class="ml-2 text-sm text-gray-600">Recordarme</span>
        </label>
      </div>

      <div class="flex items-center justify-center mt-4">
        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Ingresar
        </jet-button>
      </div>

      <div v-if="canResetPassword" class="flex items-center justify-center mt-4">
        <inertia-link :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
          ¿Olvidaste tu contraseña?
        </inertia-link>
      </div>

    </form>

    <!-- Register -->
    <template #register>
      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex justify-center">
          <inertia-link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
            Registrarse
          </inertia-link>
        </div>
      </div>
    </template>

  </authentication-card>
</template>

<script>
  import AuthenticationCard from '@/Components/AuthenticationCard'
  import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo'
  import JetButton from '@/Jetstream/Button'
  import JetInput from '@/Jetstream/Input'
  import JetCheckbox from '@/Jetstream/Checkbox'
  import JetLabel from '@/Jetstream/Label'
  import JetValidationErrors from '@/Jetstream/ValidationErrors'

  export default {
    components: {
      AuthenticationCard,
      AuthenticationCardLogo,
      JetButton,
      JetInput,
      JetCheckbox,
      JetLabel,
      JetValidationErrors
    },

    props: {
      canResetPassword: Boolean,
      status: String
    },

    data() {
      return {
        form: this.$inertia.form({
          email: '',
          password: '',
          remember: false
        })
      }
    },

    methods: {
      submit() {
        this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
      }
    }
  }
</script>
