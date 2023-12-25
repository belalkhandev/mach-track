<script setup>
import {ref} from "vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import DialogModal from "@/Components/DialogModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    machine_models: {
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
    machin_model_id: '',
    name: '',
    is_active: true
})

const submitForm = () => {
    if (!form.machin_model_id) {
        form.transform(data => ({
            ...data
        })).post(route('machine.model.create'), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Model stored successfully'
                });
                form.reset();
            },
        });
    } else {
        form.transform(data => ({
            ...data
        })).put(route('machine.model.edit', form.machin_model_id), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Model update successfully'
                });

                displayFormModal.value = false
            }
        });
    }
}

const editAction = (machine_model) => {
    form.machin_model_id = machine_model.id;
    form.name = machine_model.name;
    form.is_active = !!machine_model.is_active;

    displayFormModal.value = true
}


const deleteAction = (machin_model_id) => {
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
            form.delete(route('machine.model.delete', machin_model_id), {
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Model has been deleted successfully'
                    });
                }
            })
        }
    })
}

</script>

<template>
    <AdminPanelLayout title="Models">
        <template #header>Models</template>
        <div class="row">
            <div class="col-lg-8">
                <div class="box">
                    <div class="box-header">
                        <h5 class="title">Models</h5>
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
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(machine_model, i) in machine_models.data">
                                <td>{{ i+1 }}</td>
                                <td>{{ machine_model.name }}</td>
                                <td>
                                    <span v-if="machine_model.is_active" class="text-success">Active</span>
                                    <span v-else class="text-danger">Inactive</span>
                                </td>
                                <td>
                                    <div class="action">
                                        <ul>
                                            <li>
                                                <button @click="editAction(machine_model)" class="btn btn-sm btn-rounded btn-outline-warning"><i class="bx bx-edit"></i></button>
                                            </li>
                                            <li>
                                                <button @click="deleteAction(machine_model.id)" class="btn btn-sm btn-rounded btn-outline-danger"><i class="bx bx-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <Pagination :data="machine_models"/>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="displayFormModal"  @close="displayFormModal = false">
            <template #title>
                {{ form.machin_model_id ? 'Edit' : 'Add' }} Model
            </template>

            <template #content>
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name" placeholder="e.g: Model A">
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" v-model="form.is_active" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Status
                            <span v-if="form.is_active" class="text-success">Active</span>
                            <span v-else class="text-danger">Inactive</span>
                        </label>
                    </div>
                </form>
            </template>

            <template #footer>
                <SecondaryButton @click="displayFormModal = false">Cancel</SecondaryButton>
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.machin_model_id ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
