<script setup>
defineProps({
    status: {
        type: String,
    },
});
</script>

<template>
    <span v-if="status === 'running'" class="badge bg-success">Running</span>
    <span v-else-if="status === 'idle'" class="badge bg-info">Idle</span>
    <span v-else-if="status === 'repairable'" class="badge bg-warning">Repairable</span>
    <span v-else class="badge bg-danger">Disable</span>
</template>

<style scoped>

</style>
