<template>
<nav class="bg-gray-800 mb-6">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <Link 
                            :href="route('project.index')" 
                            :class="[
                                'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium', 
                                $page.component === 'Project/Index' ? 'bg-gray-900 text-white' : ''
                            ]"
                            >
                            Projects
                        </Link>
                        <Link 
                            :href="route('project.import')" 
                            :class="[
                                'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium', 
                                $page.component === 'Project/Import' ? 'bg-gray-900 text-white' : ''
                            ]"
                            >
                            Import
                        </Link>
                        <Link 
                            :href="route('task.index')" 
                            :class="[
                                'text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium', 
                                $page.component === 'Task/Index' ? 'bg-gray-900 text-white' : ''
                            ]"
                            >
                            Tasks
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: 'Navigation',
    components: { 
        Link,
    }
}
</script>

<style>

</style>