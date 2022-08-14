<script setup lang="ts">

import { defineProps } from 'vue';
import ComponentCustomerModalContentCreate from '@/Components/ComponentCustomerModalContentCreate.vue';
import ComponentCustomerModalContentUpdate from '@/Components/ComponentCustomerModalContentUpdate.vue';

interface Props 
{
    customers? : Object | null
}

const props = defineProps <Props>(); 

</script>

<style lang="scss">

</style>

<template>
    <h3 class="fw-bold text-secondary">
        Customers
    </h3>

    <hr class="hr" />

    <div class="container-fluid d-flex align-items-center">
        <div>
            <button 
                type="button" 
                class="btn btn-primary d-flex fw-bold"
                data-bs-toggle="modal" data-bs-target="#modalCreate"
            >
                <i class="bi bi-plus-circle fs-6"></i> 
                <span class="mx-1">New Customer</span>
            </button>
        </div>
        <div class="ms-auto me-2">
            <a 
                class="btn btn-primary d-flex align-items-center fw-bold flex-shrink-1"
                target="_blank"
                :href="route('customers.pdf')"
            >
                <i class="bi bi-printer fs-6"></i>
                <span class="mx-1">
                    Print
                </span>
            </a>
        </div>

        <div>
            <form action="">
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white" id="basic-addon1">
                        <i class="bi bi-search fs-6"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Search" aria-label="Username"
                        aria-describedby="basic-addon1">
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid my-3">
        <table class="table table-responsive table-hover shadow table-light  table-striped table-bordered align-middle">
            <thead class="bg-white">
                <tr>
                    <th></th>
                    <th>Customer Name</th>
                    <th>Contact Person</th>
                    <th>Address</th>
                    <th>Contact No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in customers" :key="item?.slug">
                    <td class="text-success text-center">
                        <i class="bi bi-plus-circle-fill">

                        </i>
                    </td>
                    <td>
                        {{item.name}}
                    </td>
                    <td>
                        {{ item.contact_person }}
                    </td>
                    <td>
                        {{item.address}}
                    </td>
                    <td>
                        {{ item.contact_number }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm text-white me-2" disabled>
                            <i class="bi bi-pen-fill fs-6"></i>
                        </button>
                        <Link 
                            :href="route('customers.destroy', {slug : item.slug})"
                            method="DELETE"
                            class="btn btn-danger btn-sm"
                            as="button"
                        >
                            <i class="bi bi-trash-fill fs-6"></i>
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container-fluid my-4 d-flex align-items-center justify-content-between">
        
        <!-- SHOW ITEMS HERE-->
        <div>
            Show 1 to 4 of 4 entries
        </div>

        <!-- PAGINATION HERE -->
        <div>
            Pagination
        </div>
    </div>

    <!-- Modal -->
    <Teleport to="body">
        <div 
            class="modal fade" 
            id="modalCreate" 
            data-bs-backdrop="static" 
            data-bs-keyboard="false" 
            tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true"
        >
            <ComponentCustomerModalContentCreate/>
        </div>
    </Teleport>

</template>