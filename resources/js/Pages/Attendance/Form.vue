<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <h1 class="text-3xl font-semibold text-neutral-950 dark:text-white mb-8">{{ isEdit ? 'Edit Attendance' : 'Record Attendance' }}</h1>

      <form @submit.prevent="submit" class="bg-white dark:bg-neutral-800 rounded-lg border border-neutral-200 dark:border-neutral-700 p-8">
        <!-- Employee -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Employee *</label>
          <select
            v-model="form.employee_id"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
            :disabled="isEdit"
          >
            <option value="">Select Employee</option>
            <option v-for="emp in employees" :key="emp.id" :value="emp.id">{{ emp.first_name }} {{ emp.last_name }}</option>
          </select>
          <InputError :message="form.errors.employee_id" class="mt-2" />
        </div>

        <!-- Date -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Date *</label>
          <input
            v-model="form.date"
            type="date"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
            :disabled="isEdit"
          />
          <InputError :message="form.errors.date" class="mt-2" />
        </div>

        <!-- Check In -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Check In Time</label>
          <input
            v-model="form.check_in"
            type="time"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
          />
          <InputError :message="form.errors.check_in" class="mt-2" />
        </div>

        <!-- Check Out -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Check Out Time</label>
          <input
            v-model="form.check_out"
            type="time"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
          />
          <InputError :message="form.errors.check_out" class="mt-2" />
        </div>

        <!-- Status -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Status *</label>
          <select
            v-model="form.status"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            required
          >
            <option value="present">Present</option>
            <option value="absent">Absent</option>
            <option value="late">Late</option>
            <option value="half-day">Half Day</option>
            <option value="on-leave">On Leave</option>
          </select>
          <InputError :message="form.errors.status" class="mt-2" />
        </div>

        <!-- Notes -->
        <div class="mb-6">
          <label class="block text-sm font-medium text-neutral-950 dark:text-white mb-2">Notes</label>
          <textarea
            v-model="form.notes"
            class="w-full px-4 py-2 border border-neutral-200 dark:border-neutral-700 rounded-lg dark:bg-neutral-900 dark:text-white"
            rows="3"
          ></textarea>
          <InputError :message="form.errors.notes" class="mt-2" />
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-4">
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition disabled:opacity-50"
          >
            {{ isEdit ? 'Update Attendance' : 'Record Attendance' }}
          </button>
          <Link href="/attendance" class="bg-neutral-200 dark:bg-neutral-700 hover:bg-neutral-300 dark:hover:bg-neutral-600 text-neutral-950 dark:text-white px-6 py-2 rounded-lg font-medium transition flex items-center">
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
  record: Object,
  employees: Array,
})

const isEdit = computed(() => !!props.record)

const form = useForm({
  employee_id: props.record?.employee_id || '',
  date: props.record?.date || '',
  check_in: props.record?.check_in || '',
  check_out: props.record?.check_out || '',
  status: props.record?.status || 'present',
  notes: props.record?.notes || '',
})

const submit = () => {
  if (isEdit.value) {
    form.put(`/attendance/${props.record.id}`, {
      preserveScroll: true,
    })
  } else {
    form.post('/attendance', {
      preserveScroll: true,
    })
  }
}
</script>
