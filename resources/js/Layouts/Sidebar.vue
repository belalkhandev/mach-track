<script setup>
import NavLink from "@/Components/NavLink.vue";
import {ref} from "vue";

const getActivePath = (routeName) => {
    const url = new URL(routeName)
    return url.pathname
}

let sidebarHidden = ref(false);
const toggleSidebar = () => {
    sidebarHidden.value = !sidebarHidden.value
}

</script>

<template>
    <span class="sidebar-toggle" @click="toggleSidebar">
        <i class='bx bx-menu-alt-left'></i>
    </span>
    <aside class="sidebar" :class="{ 'toggle-sidebar': sidebarHidden }">
        <div class="sidebar-items">
            <div class="sidebar-item">
                <div class="sidebar-item-body">
                    <ul>
                        <li :class="{ 'active': $page.url === getActivePath(route('dashboard')) }">
                            <NavLink :href="route('dashboard')">
                                <i class="bx bx-tachometer"></i>
                                Dashboard
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-item-header">
                        <span class="icon">
                            <i class="bx bx-cog"></i>
                        </span>
                    <h4>Configurations</h4>
                </div>
                <div class="sidebar-item-body">
                    <ul>
                        <li :class="{ 'active': $page.url === getActivePath(route('category.index')) }">
                            <NavLink :href="route('category.index')">
                                <i class='bx bx-radio-circle-marked' ></i>
                                Categories
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('model.index')) }">
                            <NavLink :href="route('model.index')">
                                <i class='bx bx-radio-circle-marked' ></i>
                                Models
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('brand.index')) }">
                            <NavLink :href="route('brand.index')">
                                <i class='bx bx-radio-circle-marked' ></i>
                                Brands
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('building.index')) }">
                            <NavLink :href="route('building.index')">
                                <i class='bx bx-radio-circle-marked' ></i>
                                Buildings
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('floor.index')) }">
                            <NavLink :href="route('floor.index')">
                                <i class='bx bx-radio-circle-marked' ></i>
                                Floors
                            </NavLink>
                        </li>
                        <li :class="{ 'active': $page.url === getActivePath(route('settings.index')) }">
                            <NavLink :href="route('settings.index')">
                                <i class='bx bx-radio-circle-marked' ></i>
                                Settings
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-item-header">
                        <span class="icon">
                            <i class='bx bx-line-chart' ></i>
                        </span>
                    <h4>Reports</h4>
                </div>
                <div class="sidebar-item-body">
                    <ul>
                    </ul>
                </div>
            </div>
        </div>

    </aside>
</template>

<style scoped>

</style>
