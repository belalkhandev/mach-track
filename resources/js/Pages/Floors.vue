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
    floors: {
        type: Object,
        default: () => ({})
    },
    buildings: {
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
    floor_id: '',
    building_id: '',
    name: '',
    is_active: true
})

const submitForm = () => {
    if (!form.floor_id) {
        form.transform(data => ({
            ...data
        })).post(route('floor.create'), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Floor stored successfully'
                });
                form.reset();
            },
        });
    } else {
        form.transform(data => ({
            ...data
        })).put(route('floor.edit', form.floor_id), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Floor update successfully'
                });

                displayFormModal.value = false
            }
        });
    }
}

const editAction = (floor) => {
    form.floor_id = floor.id;
    form.building_id = floor.building_id;
    form.name = floor.name;
    form.is_active = !!floor.is_active;

    displayFormModal.value = true
}


const deleteAction = (floor_id) => {
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
            form.delete(route('floor.delete', floor_id), {
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Floor has been deleted successfully'
                    });
                }
            })
        }
    })
}

</script>

<template>
    <AdminPanelLayout title="Floors">
        <template #header>Floors</template>
        <div class="row">
            <div class="col-lg-8">
                <div class="box">
                    <div class="box-header">
                        <h5 class="title">Floors</h5>
                        <div class="action">
                            <button @click="showFormModal" class="btn btn-sm btn-rounded btn-outline-primary"><i class="bx bx-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Floor</th>
                                <th>Building</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(floor, i) in floors.data">
                                <td>{{ i+1 }}</td>
                                <td>{{ floor.building.name }}</td>
                                <td>{{ floor.name }}</td>
                                <td>
                                    <span v-if="floor.is_active" class="text-success">Active</span>
                                    <span v-else class="text-danger">Inactive</span>
                                </td>
                                <td>
                                    <div class="action">
                                        <ul>
                                            <li>
                                                <button @click="editAction(floor)" class="btn btn-sm btn-rounded btn-outline-warning"><i class="bx bx-edit"></i></button>
                                            </li>
                                            <li>
                                                <button @click="deleteAction(floor.id)" class="btn btn-sm btn-rounded btn-outline-danger"><i class="bx bx-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <Pagination :data="floors"/>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="displayFormModal"  @close="displayFormModal = false">
            <template #title>
                {{ form.floor_id ? 'Edit' : 'Add' }} floor
            </template>

            <template #content>
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label>Building</label>
                        <select v-model="form.building_id" class="form-select form-control">
                            <option value="">Select</option>
                            <option v-for="building in buildings" :value="building.id">{{ building.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.building_id" />
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name" placeholder="e.g: Floor A">
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
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.floor_id ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
