<script setup lang="ts">

import { ref, defineProps } from "vue";
import type { Ref } from 'vue';
import route from "../../../vendor/tightenco/ziggy/src/js";

interface Items
{
    name    : string;
    icon    : string;
    link    : string;
    group   : string;
    isActive: boolean;
}

const isActive: Ref<boolean> = ref(true); 

const toggleStateActive = () => 
{
    isActive.value = !isActive.value; 
}

const items: Items[] = 
[
    {
        name    : 'Dashboard',
        icon    : 'bi bi-house-door',
        link    : 'home',
        group   : 'Home', 
        isActive: true,
    },    
    {
        name    : 'Customers',
        icon    : 'bi bi-people',
        link    : 'customers',
        group   : 'Customer',
        isActive: true,
    }, 
    {
        name    : 'Settings',
        icon    : 'bi bi-gear-fill',
        link    : 'home',
        group   : 'Setting',
        isActive: false,
    }
] 

</script>

<style scoped lang="scss">

#sidebar 
{
    height          : 100vh;
    background-image: linear-gradient(to top left, #66ffff 0%, #000099 100%);
    color           : #fff;
    width           : 60px;
    position        : fixed; 
    top             : 0; 
    left            : 0;
    overflow-y      : auto;
    overflow-x      : hidden;
    transition      : all 0.5s ease; 
    z-index         : 1; 

    &.active 
    {
        width : 240px; 
    }

    .list-group-item 
    {
        transition : 0.5s linear;

        &:hover 
        {
            background-color : #ffffff10 !important;
        }
    }
}

</style>

<template>
    <div id="sidebar" :class="{ 'active' : isActive }">
        <nav>
            <!-- SIDEBAR TITLE-->
            <div class="p-3 border-bottom border-white">
                <div v-if="isActive" class="d-flex justify-content-center align-items-center text-center">
                    <div class="">
                        <span class="fw-bolder">
                            Customer Management System
                        </span>
                    </div>
                    <div class="">
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            width="16" 
                            height="16" 
                            fill="currentColor"
                            class="bi bi-x-circle cursor-pointer" 
                            viewBox="0 0 16 16"
                            @click="toggleStateActive" 
                        >
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </div>
                </div>
                <div v-else class="d-flex justify-content-center">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        width="32" 
                        height="32" 
                        fill="currentColor"
                        class="bi bi-list cursor-pointer" 
                        viewBox="0 0 16 16"
                        @click="toggleStateActive" 
                    >
                        <path fill-rule="evenodd"
                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </div>
            </div>
    
            <!-- SIDEBAR ITEMS-->
            <div>
                <ul class="list-group list-group-flush">
                    <template v-for="item in items" :key="item.name">
                        <li 
                            :class="
                            [ 
                                'list-group-item', 
                                'list-group-item-action', 
                                'text-white', 
                                'd-flex align-items-center',  
                                $page.component.startsWith(item.group)  ? 'active' : 'bg-transparent'
                            ]"
                        >
                            <Link 
                                :href="route(item.link)" 
                                :class="
                                    [
                                        item.isActive ? 'text-white' : 'text-secondary pe-none', 
                                        'text-decoration-none'       
                                    ]
                                "
                                >
                                <i :class="item.icon" class="fs-4"></i>
                                <span
                                    v-if="isActive" 
                                    class="fw-bold mx-2"
                                >
                                    {{ item.name }}
                                </span>
                            </Link>
                        </li>
                    </template>
                </ul>
            </div>
        </nav>
    </div>
</template>