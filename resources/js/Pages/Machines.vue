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

const props = defineProps({
    machines: {
        type: Object,
        default: () => ({})
    },
    categories: {
        type: Object,
        default: () => ({})
    },
    brands: {
        type: Object,
        default: () => ({})
    },
    machine_models: {
        type: Object,
        default: () => ({})
    },
    transmission_types: {
        type: Object,
        default: () => ({})
    },
    machine_statuses: {
        type: Object,
        default: () => ({})
    },
    floors: {
        type: Object,
        default: () => ({})
    }
});

const displayFormModal = ref(false);

const showFormModal = () => {
    form.reset();
    displayFormModal.value = !displayFormModal.value
}

const form = useForm({
    machine_id: '',
    category_id: '',
    brand_id: '',
    machine_model_id: '',
    floor_id: '',
    machine_number: '',
    local_number: '',
    transmission_type: '',
    note: '',
    status: '',
    is_rented: false,
})

const submitForm = () => {
    if (!form.machine_id) {
        form.transform(data => ({
            ...data
        })).post(route('machine.create'), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Machine stored successfully'
                });
                form.reset();
            },
        });
    } else {
        form.transform(data => ({
            ...data
        })).put(route('machine.edit', form.machine_id), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Machine update successfully'
                });

                displayFormModal.value = false
            }
        });
    }
}

const editAction = (machine) => {
    form.machine_id = machine.id;
    form.category_id = machine.category_id;
    form.brand_id = machine.brand_id;
    form.machine_model_id = machine.machine_model_id;
    form.floor_id = machine.floor_id;
    form.machine_number = machine.machine_number;
    form.local_number = machine.local_number;
    form.transmission_type = machine.transmission_type;
    form.status = machine.status;
    form.is_rented = !!machine.is_rented;

    displayFormModal.value = true
}


const deleteAction = (machine_id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0284c7',
        cancelButtonColor: '#DC2626',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('machine.delete', machine_id), {
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Machine has been deleted successfully'
                    });
                }
            })
        }
    })
}

</script>

<template>
    <AdminPanelLayout title="Machines">
        <template #header>Machines</template>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h5 class="title">Machines</h5>
                        <div class="action">
                            <button @click="showFormModal" class="btn btn-sm btn-rounded btn-outline-primary"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Machine No</th>
                                <th>Model/Type</th>
                                <th>Status</th>
                                <th>Rented?</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(machine, i) in machines.data">
                                <td>{{ i+1 }}</td>
                                <td>
                                    {{ machine.category.name }}
                                    <p class="text-secondary" v-if="machine.brand">Brand: {{ machine.brand.name }} </p>
                                </td>
                                <td>
                                    {{ machine.machine_number }}
                                    <p class="text-secondary" v-if="machine.local_number">Local no: {{ machine.local_number }}</p>
                                </td>
                                <td>
                                    <p v-if="machine.machine_model">Model: {{ machine.machine_model.name }} </p>
                                    <p class="text-secondary" v-if="machine.transmission_type">{{ machine.transmission_type.charAt(0).toUpperCase()+machine.transmission_type.slice(1) }} </p>
                                </td>
                                <td>
                                    <MachinStatusLabel :status="machine.status"/>
                                </td>
                                <td>
                                    <span v-if="machine.is_rented" class="badge bg-warning">Yes</span>
                                    <span v-else class="badge bg-info">No</span>
                                </td>
                                <td>
                                    <div class="action">
                                        <ul>
                                            <li>
                                                <button @click="editAction(machine)" class="btn btn-sm btn-rounded btn-outline-warning"><i class="bx bx-edit"></i></button>
                                            </li>
                                            <li>
                                                <button @click="deleteAction(machine.id)" class="btn btn-sm btn-rounded btn-outline-danger"><i class="bx bx-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <Pagination :data="machines"/>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="displayFormModal"  @close="displayFormModal = false">
            <template #title>
                {{ form.machine_id ? 'Edit' : 'Add' }} Machine
            </template>

            <template #content>
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label>Machine name</label>
                        <select v-model="form.category_id" class="form-select form-control">
                            <option value="">Select</option>
                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.category_id" />
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Brand</label>
                                <select v-model="form.brand_id" class="form-select form-control">
                                    <option value="">Select</option>
                                    <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.brand_id" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Model</label>
                                <select v-model="form.machine_model_id" class="form-select form-control">
                                    <option value="">Select</option>
                                    <option v-for="model in machine_models" :value="model.id">{{ model.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.machine_model_id" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Machine number</label>
                                <input type="text" class="form-control" v-model="form.machine_number" placeholder="e.g: 1020597744">
                                <InputError class="mt-2" :message="form.errors.machine_number" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Local number</label>
                                <input type="text" class="form-control" v-model="form.local_number" placeholder="e.g: EA-01-01-54">
                                <InputError class="mt-2" :message="form.errors.local_number" />
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Transmission Type</label>
                                <select v-model="form.transmission_type" class="form-select form-control">
                                    <option value="">Select</option>
                                    <option v-for="transmission_type in transmission_types" :value="transmission_type">{{ transmission_type.charAt(0).toUpperCase()+transmission_type.slice(1) }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.transmission_type" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Machine Status</label>
                                <select v-model="form.status" class="form-select form-control">
                                    <option value="">Select</option>
                                    <option v-for="status in machine_statuses" :value="status">{{ status.charAt(0).toUpperCase()+status.slice(1) }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.status" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Floor/Location</label>
                        <select v-model="form.floor_id" class="form-select form-control">
                            <option value="">Select</option>
                            <option v-for="floor in floors" :value="floor.id">{{ floor.name }} - ({{ floor.building.name }})</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.floor_id" />
                    </div>

                    <div class="form-group">
                        <label>Notes <small class="text-muted">(Optional)</small></label>
                        <textarea v-model="form.note" class="form-control form-control-textarea" placeholder="Write note" rows="3"></textarea>
                        <InputError class="mt-2" :message="form.errors.note" />
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" v-model="form.is_rented" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Is Rented?
                            <span v-if="form.is_rented" class="text-warning">Yes</span>
                            <span v-else class="text-success">No</span>
                        </label>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton @click="displayFormModal = false">Cancel</SecondaryButton>
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.machine_id ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
