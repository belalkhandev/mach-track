<script setup>
import {ref} from "vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Pagination from "@/Components/Pagination.vue";
import MachinStatusLabel from "@/Components/MachinStatusLabel.vue";
import moment from "moment";

const props = defineProps({
    machine: {
        type: Object,
        default: () => ({})
    },
});


</script>

<template>
    <AdminPanelLayout title="Machines Details">
        <template #header>Machines Details</template>
        <div class="box">
            <div class="box-header no-border">
                <h5 class="title">Machine Details</h5>
                <Link :href="route('machine.index')" class="btn btn-sm btn-primary">Machine list</Link>
            </div>
            <div class="box-body">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div>
                        <label>Name</label>
                        <h5>{{ machine.category.name }}</h5>
                    </div>
                    <div>
                        <label>Model</label>
                        <h6>{{ machine.machine_model?.name ?? '-' }}</h6>
                    </div>
                    <div>
                        <label>Brand</label>
                        <h6>{{ machine.brand?.name ?? '-' }}</h6>
                    </div>
                    <div>
                        <label>Floor</label>
                        <h6>{{ machine.floor?.name }} - ({{ machine.floor?.building.name }})</h6>
                    </div>
                    <div>
                        <label>Machine number</label>
                        <h6>{{ machine.machine_number ?? '-' }}</h6>
                    </div>
                    <div>
                        <label>Local number</label>
                        <h6>{{ machine.local_number ?? '-' }}</h6>
                    </div>
                    <div>
                        <label>Machine Type</label>
                        <h6>{{ machine.transmission_type ?? '-' }}</h6>
                    </div>
                    <div>
                        <label>Status</label>
                        <p class="m-0"><MachinStatusLabel :status="machine.status"/></p>
                    </div>
                </div>
            </div>
            <div class="box-footer">

            </div>
        </div>
        <div class="box">
            <div class="box-header no-border">
                <h5 class="title">Notes</h5>
            </div>
            <div class="box-body">
                <div class="notes">
                    <div v-for="note in machine.notes" class="note bg-slate-50 border-1 p-2 rounded-1 mb-2">
                        <p class="mb-1">{{ note.note }}</p>
                        <small class="mt-2 m-0"><i class="bx bx-calendar"></i> {{ moment(note.created_at).format('LLL') }}</small>
                    </div>
                </div>
            </div>
        </div>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
