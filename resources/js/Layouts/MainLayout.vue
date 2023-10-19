<template>
    <div class="w-3/4 mx-auto">
        <navigation></navigation>
        <slot></slot>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';

export default {
    name: 'MainLayout',
    components: { 
        Link,
        Navigation,
    }
}
</script>

<style>

</style>