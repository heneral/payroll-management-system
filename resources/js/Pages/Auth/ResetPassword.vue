<template>
  <div class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
      <div class="bg-white dark:bg-slate-800 rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white text-center mb-2">
          Reset Password
        </h1>
        <p class="text-center text-slate-600 dark:text-slate-400 mb-8">
          Enter your new password
        </p>

        <form @submit.prevent="submit" class="space-y-4">
          <input type="hidden" v-model="form.token" />

          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
              Email Address
            </label>
            <input
              v-model="form.email"
              type="email"
              required
              class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
              New Password
            </label>
            <input
              v-model="form.password"
              type="password"
              required
              class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <InputError :message="form.errors.password" class="mt-2" />
          </div>

          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
              Confirm Password
            </label>
            <input
              v-model="form.password_confirmation"
              type="password"
              required
              class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <InputError :message="form.errors.password_confirmation" class="mt-2" />
          </div>

          <button
            type="submit"
            :disabled="form.processing"
            class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition disabled:opacity-50"
          >
            {{ form.processing ? 'Resetting...' : 'Reset Password' }}
          </button>
        </form>

        <div class="mt-6 text-center">
          <p class="text-slate-600 dark:text-slate-400">
            <Link href="/login" class="text-blue-600 hover:text-blue-700 font-semibold">
              Back to login
            </Link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post('/reset-password');
};
</script>
