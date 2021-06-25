<template>
  <authentication-card>
    <template #logo>
      <authentication-card-logo />
    </template>

    <jet-validation-errors class="mb-4" />

    <!-- Register form -->
    <form @submit.prevent="submit">
      <div>
        <jet-label for="name" value="Nombre" />
        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
      </div>

      <div class="mt-4">
        <jet-label for="email" value="Email" />
        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
      </div>

      <div class="mt-4">
        <jet-label for="cell_phone_number" value="Número móvil" />
        <jet-input id="cell_phone_number" type="text" class="mt-1 block w-full" v-model="form.cell_phone_number" required />
      </div>

      <div class="mt-4">
        <jet-label for="password" value="Contraseña" />
        <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
      </div>

      <div class="mt-4">
        <jet-label for="password_confirmation" value="Confirmar Contraseña" />
        <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
      </div>

      <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
        <jet-label for="terms">
          <div class="flex items-center">
            <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

            <div class="ml-2">
              I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
            </div>
          </div>
        </jet-label>
      </div>

      <div class="flex items-center justify-center mt-4">
        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Registrarse
        </jet-button>
      </div>

      <div class="flex items-center justify-center mt-4">
        <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
          ¿Ya estás registrado?
        </inertia-link>
      </div>
    </form>

  </authentication-card>
</template>

<script>
  import AuthenticationCard from '@/Components/AuthenticationCard'
  import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo'
  import JetButton from '@/Jetstream/Button'
  import JetInput from '@/Jetstream/Input'
  import JetCheckbox from "@/Jetstream/Checkbox";
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

    data() {
      return {
        form: this.$inertia.form({
          name: '',
          email: '',
          cell_phone_number: '',
          password: '',
          password_confirmation: '',
          terms: false,
        })
      }
    },

    methods: {
      submit() {
        this.form.post(this.route('register'), {
          onFinish: () => this.form.reset('password', 'password_confirmation'),
        })
      }
    }
  }
</script>
