<template>
    <Link 
        :href="route('task.index')" 
        class="bg-gray-500 hover:bg-gray-700 text-white rounded-md px-3 py-2 text-sm font-medium">
        Back
    </Link>
    <table v-if="failedList" class="border-collapse table-auto w-full text-sm mt-4">
        <thead>
            <tr>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Key</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Row</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Message</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Task_id</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
            <tr v-for="failedRow in failedList.data" :key="failedRow.id">
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ failedRow.key }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ failedRow.row }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ failedRow.message }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ failedRow.task_id }}</td>
            </tr>
        </tbody>
    </table>
    <Pagination :meta="failedList.meta"></pagination>
</template>

<script>
import Pagination from "@/Components/Pagination.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
export default {
    name: 'FailedList',
    layout: MainLayout,

    components: {
    Link,
    Pagination
},

    props: [
        'failedList'
    ],
}
</script>

<style>

</style>