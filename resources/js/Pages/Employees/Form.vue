<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <h1 class="text-3xl font-semibold text-neutral-950 dark:text-white mb-8">{{ isEdit ? 'Edit Employee' : 'Add New Employee' }}</h1>

      <form @submit.prevent="submit" class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-8">
        <!-- Employee ID -->
        <div class="mb-6" v-if="!isEdit">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Employee ID</label>
          <input
            v-model="form.employee_id"
            type="text"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            placeholder="e.g., EMP001"
          />
          <InputError :message="form.errors.employee_id" class="mt-2" />
        </div>

        <!-- First Name -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">First Name</label>
          <input
            v-model="form.first_name"
            type="text"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          />
          <InputError :message="form.errors.first_name" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Last Name</label>
          <input
            v-model="form.last_name"
            type="text"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          />
          <InputError :message="form.errors.last_name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Email</label>
          <input
            v-model="form.email"
            type="email"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          />
          <InputError :message="form.errors.email" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Phone</label>
          <input
            v-model="form.phone"
            type="tel"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
          />
          <InputError :message="form.errors.phone" class="mt-2" />
        </div>

        <!-- Position -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Position</label>
          <input
            v-model="form.position"
            type="text"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          />
          <InputError :message="form.errors.position" class="mt-2" />
        </div>

        <!-- Base Salary -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Base Salary</label>
          <input
            v-model.number="form.base_salary"
            type="number"
            step="0.01"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          />
          <InputError :message="form.errors.base_salary" class="mt-2" />
        </div>

        <!-- Hire Date -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Hire Date</label>
          <input
            v-model="form.hire_date"
            type="date"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          />
          <InputError :message="form.errors.hire_date" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Status</label>
          <select
            v-model="form.status"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
          >
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
            <option value="on_leave">On Leave</option>
          </select>
          <InputError :message="form.errors.status" class="mt-2" />
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-4">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition disabled:opacity-50"
          >
            {{ isEdit ? 'Update Employee' : 'Create Employee' }}
          </button>
          <Link href="/employees" class="bg-neutral-200 dark:bg-neutral-700 hover:bg-neutral-300 dark:hover:bg-neutral-600 text-neutral-950 dark:text-white px-6 py-2 rounded-lg font-medium transition flex items-center">
            Cancel
          </Link>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { computed } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputError from '@/Components/InputError.vue'

const props = defineProps({
  employee: Object,
})

const isEdit = computed(() => !!props.employee)

const form = useForm({
  employee_id: props.employee?.employee_id || '',
  first_name: props.employee?.first_name || '',
  last_name: props.employee?.last_name || '',
  email: props.employee?.email || '',
  phone: props.employee?.phone || '',
  position: props.employee?.position || '',
  base_salary: props.employee?.base_salary || '',
  hire_date: props.employee?.hire_date || '',
  status: props.employee?.status || 'active',
})

const submit = () => {
  if (isEdit.value) {
    form.put(`/employees/${props.employee.id}`, {
      preserveScroll: true,
    })
  } else {
    form.post('/employees', {
      preserveScroll: true,
    })
  }
}
</script>
