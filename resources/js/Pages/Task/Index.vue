<template>
    <table v-if="tasks" class="border-collapse table-auto w-full text-sm">
        <thead>
            <tr>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">ID</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">User</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">File</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Status</th>
                <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Failed rows</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-slate-800">
            <tr v-for="task in tasks.data" :key="task.id">
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ task.id }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ task.user.name }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ task.file.path }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{ task.status }}</td>
                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                    <Link v-if="task.failedRowsCount > 0" :href="route('task.failed_rows', task.id)" >
                        Failed rows
                    </Link>
                    <span v-else>-</span>
                </td>
            </tr>
        </tbody>
    </table>
    <pagination :meta="tasks.meta"></pagination>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
export default {
    name: 'Index',
    layout: MainLayout,

    components: {
        Link,
        Pagination
    },

    props: [
        'tasks',
    ],
}
</script>

<style>

</style>