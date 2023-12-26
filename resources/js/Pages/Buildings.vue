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
    building_id: '',
    name: '',
    is_active: true
})

const submitForm = () => {
    if (!form.building_id) {
        form.transform(data => ({
            ...data
        })).post(route('building.create'), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Building stored successfully'
                });
                form.reset();
            },
        });
    } else {
        form.transform(data => ({
            ...data
        })).put(route('building.edit', form.building_id), {
            onSuccess: () => {
                Toast.fire({
                    icon: 'success',
                    title: 'Building update successfully'
                });

                displayFormModal.value = false
            }
        });
    }
}

const editAction = (building) => {
    form.building_id = building.id;
    form.name = building.name;
    form.is_active = !!building.is_active;

    displayFormModal.value = true
}


const deleteAction = (building_id) => {
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
            form.delete(route('building.delete', building_id), {
                onSuccess: () => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Building has been deleted successfully'
                    });
                }
            })
        }
    })
}

</script>

<template>
    <AdminPanelLayout title="Buildings">
        <template #header>Buildings</template>
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h5 class="title">Buildings</h5>
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
                            <tr v-for="(building, i) in buildings.data">
                                <td>{{ i+1 }}</td>
                                <td>{{ building.name }}</td>
                                <td>
                                    <span v-if="building.is_active" class="text-success">Active</span>
                                    <span v-else class="text-danger">Inactive</span>
                                </td>
                                <td>
                                    <div class="action">
                                        <ul>
                                            <li>
                                                <button @click="editAction(building)" class="btn btn-sm btn-rounded btn-outline-warning"><i class="bx bx-edit"></i></button>
                                            </li>
                                            <li>
                                                <button @click="deleteAction(building.id)" class="btn btn-sm btn-rounded btn-outline-danger"><i class="bx bx-trash"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <Pagination :data="buildings"/>
                    </div>
                </div>
            </div>
        </div>

        <DialogModal :show="displayFormModal"  @close="displayFormModal = false">
            <template #title>
                {{ form.building_id ? 'Edit' : 'Add' }} building
            </template>

            <template #content>
                <form @submit.prevent="submitForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name" placeholder="e.g: Building A">
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
                <PrimaryButton @click="submitForm" class="ml-3">{{ form.building_id ? 'Update' : 'Save' }}</PrimaryButton>
            </template>
        </DialogModal>

    </AdminPanelLayout>
</template>

<style scoped>

</style>
