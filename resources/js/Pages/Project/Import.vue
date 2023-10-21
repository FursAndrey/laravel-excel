<template>
    <div>
        <form>
            <input @change="setExcel" type="file" ref="file" class="hidden">
            <div class="flex">
                <span @click="selectExcel" class="block bg-green-600 rounded-full text-white p-4 text-center w-32 cursor-pointer">Excel</span>
                <span v-if="file" @click="importExcel" class="ms-4 block bg-sky-600 rounded-full text-white p-4 text-center w-32 cursor-pointer">Import</span>
            </div>
        </form>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
export default {
    name: 'Import',
    layout: MainLayout,

    data() {
        return {
            file: null,
        };
    },

    methods: {
        selectExcel() {
            this.$refs.file.click();
        },

        setExcel(e) {
            this.file = e.target.files[0];
        },

        importExcel() {
            const formData = new FormData;
            formData.append('file', this.file);

            this.$inertia.post('/projects/import', formData);
        }
    }
}
</script>

<style>

</style>