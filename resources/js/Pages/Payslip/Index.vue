<template>
  <AppLayout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Payslips</h1>
        <Link href="/payslips/create" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
          Generate Payslip
        </Link>
      </div>

      <!-- Filters -->
      <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Employee</label>
            <select v-model="filters.employee_id" @change="applyFilters" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md dark:bg-slate-700 dark:border-slate-600">
              <option value="">All Employees</option>
              <option v-for="employee in employees" :key="employee.id" :value="employee.id">
                {{ employee.first_name }} {{ employee.last_name }}
              </option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Status</label>
            <select v-model="filters.status" @change="applyFilters" class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md dark:bg-slate-700 dark:border-slate-600">
              <option value="">All Status</option>
              <option value="draft">Draft</option>
              <option value="approved">Approved</option>
              <option value="paid">Paid</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Search</label>
            <input v-model="searchQuery" type="text" placeholder="Search..." class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md dark:bg-slate-700 dark:border-slate-600">
          </div>
        </div>
      </div>

      <!-- Payslips Table -->
      <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
          <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-white">Employee</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-white">Payslip #</th>
              <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-white">Gross Pay</th>
              <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-white">Net Pay</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
              <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-white">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
            <tr v-for="payslip in filteredPayslips" :key="payslip.id" class="hover:bg-slate-50 dark:hover:bg-slate-700">
              <td class="px-6 py-4 text-slate-900 dark:text-slate-100">{{ payslip.employee.first_name }} {{ payslip.employee.last_name }}</td>
              <td class="px-6 py-4 text-slate-900 dark:text-slate-100">{{ payslip.payslip_number || `PS-${payslip.id}` }}</td>
              <td class="px-6 py-4 text-right text-slate-900 dark:text-slate-100">{{ formatCurrency(payslip.gross_pay) }}</td>
              <td class="px-6 py-4 text-right text-slate-900 dark:text-slate-100">{{ formatCurrency(payslip.net_pay) }}</td>
              <td class="px-6 py-4">
                <span :class="{
                  'bg-amber-200 text-amber-800': payslip.status === 'draft',
                  'bg-blue-200 text-blue-800': payslip.status === 'approved',
                  'bg-emerald-200 text-emerald-800': payslip.status === 'paid',
                }" class="px-3 py-1 rounded-full text-xs font-semibold">
                  {{ payslip.status.charAt(0).toUpperCase() + payslip.status.slice(1) }}
                </span>
              </td>
              <td class="px-6 py-4">
                <Link :href="`/payslips/${payslip.id}`" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-200 mr-4">View</Link>
              </td>
            </tr>
          </tbody>
        </table>
        <div v-if="filteredPayslips.length === 0" class="p-6 text-center text-slate-500">
          No payslips found
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  payslips: Array,
  employees: Array,
});

const searchQuery = ref('');
const filters = ref({
  employee_id: '',
  status: '',
});

const filteredPayslips = computed(() => {
  return props.payslips.filter(payslip => {
    const matchesEmployee = !filters.value.employee_id || payslip.employee_id == filters.value.employee_id;
    const matchesStatus = !filters.value.status || payslip.status === filters.value.status;
    const matchesSearch = !searchQuery.value || 
      payslip.employee.first_name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      payslip.employee.last_name.toLowerCase().includes(searchQuery.value.toLowerCase());
    
    return matchesEmployee && matchesStatus && matchesSearch;
  });
});

const applyFilters = () => {
  // Filters are applied reactively via computed property
};

const formatCurrency = (value) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  }).format(value);
};
</script>
