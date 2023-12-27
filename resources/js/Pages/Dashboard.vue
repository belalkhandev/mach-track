<script setup>
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import MonthlyBillCollectionChart from "@/Components/Charts/MonthlyBillCollectionChart.vue";
import {Link} from "@inertiajs/vue3";
import moment from "moment";
import PaymentStatusLabel from "@/Components/PaymentStatusLabel.vue";

const props = defineProps({
    running_count: {
        type: Number,
        default: 0
    },
    idle_count: {
        type: Number,
        default: 0
    },
    repairable_count: {
        type: Number,
        default: 0
    },
    disable_count: {
        type: Number,
        default: 0
    }
});

</script>

<template>
    <AdminPanelLayout title="Dashboard">
        <template #header>Dashboard</template>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="dashboard-card card-2">
                    <i class='bx bx-radio-circle-marked'></i>
                    <div class="card-header">
                        <h5>Running</h5>
                    </div>
                    <div class="card-content">
                        <h2>{{ running_count }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="dashboard-card card-3">
                    <i class='bx bx-radio-circle-marked'></i>
                    <div class="card-header">
                        <h5>Idle</h5>
                    </div>
                    <div class="card-content">
                        <h2>{{ idle_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="dashboard-card card-1">
                    <i class='bx bx-radio-circle-marked'></i>
                    <div class="card-header">
                        <h5>Repairable</h5>
                    </div>
                    <div class="card-content">
                        <h2>{{ repairable_count }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="dashboard-card card-4">
                    <i class='bx bx-radio-circle-marked'></i>
                    <div class="card-header">
                        <h5>Disable</h5>
                    </div>
                    <div class="card-content">
                        <h2>{{ disable_count }}</h2>
                    </div>
                </div>
            </div>
        </div>

    </AdminPanelLayout>
</template>
