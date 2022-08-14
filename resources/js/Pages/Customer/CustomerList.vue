<script setup lang="ts">

import { defineProps, ref, computed, watch } from 'vue';
import debounce from 'lodash/debounce';
import { Inertia } from "@inertiajs/inertia";

import ComponentCustomerModalContentCreate from '@/Components/ComponentCustomerModalContentCreate.vue';
import ComponentCustomerModalContentUpdate from '@/Components/ComponentCustomerModalContentUpdate.vue';
import ComponentAppPagination from '@/Components/ComponentAppPagination.vue'; 

interface Props 
{
    customers? : Object | null
}

const props = defineProps <Props>(); 

const refCurrentPage   = ref<number>(props.customers.current_page);
const refSearchQuery   = ref<string | null>(null);
const refSortBy        = ref<string | null>(null);
const refSortDirection = ref<string>('asc');
const refShowItems     = ref<number>(props.customers.per_page);
const refTotalItems    = computed(() => props.customers.total);

const refVisiblePages = ref<number>(10);

const optionsItemShow = 
    [
        {
            'label'   : 10,
            'value'   : 10,
            'selected': true,
        },
        {
            'label'   : 25,
            'value'   : 25,
            'selected': false,
        },
        {
            'label'   : 50,
            'value'   : 50,
            'selected': false,
        },
        {
            'label'   : 100,
            'value'   : 100,
            'selected': false,
        },
        {
            'label'   : 1000,
            'value'   : 1000,
            'selected': false,
        }
    ];

const onPageChange = (page) => 
{
    refCurrentPage.value = page;
};

const dataMeta = computed(() => 
    {
        return {
            from : (0 + 1) + (refShowItems.value * (refCurrentPage.value - 1)),
            to   : (refShowItems.value * (refCurrentPage.value)) > refTotalItems.value ? refTotalItems.value : (refShowItems.value * (refCurrentPage.value)),
            of   : refTotalItems.value,
            pages: Math.ceil(refTotalItems.value / refShowItems.value)
        }
    }
);

watch(
    [refCurrentPage, refSortBy, refSortDirection],
    debounce(function () 
        {
            const requestData : Object =
            {
                'search'     : refSearchQuery.value,
                'sizePerPage': refShowItems.value,
                'showPage'   : refCurrentPage.value,
                'sortBy'     : refSortBy.value,
                'sortDirection'   : refSortDirection.value,
            };

            onChangeRequest(requestData);
        },
        250
    )
);

watch(
    [refShowItems, refSearchQuery],
    debounce(function () 
        {
            refCurrentPage.value = 1;

            const requestData : Object =
            {
                'search'     : refSearchQuery.value,
                'sizePerPage': refShowItems.value,
                'showPage'   : refCurrentPage.value,
                'sortBy'     : refSortBy.value,
                'sortDirection'   : refSortDirection.value,
            };

            onChangeRequest(requestData);
        },
        250
    )
); 

const sortColumn = (column : string) => 
{
    if (refSortBy.value == column) 
    {
        if (refSortDirection.value == 'asc')
        {
            refSortDirection.value = 'desc'; 
        }
        else 
        {
            refSortDirection.value = 'asc'; 
        }
    }
    else 
    {
        refSortBy.value = column;  
    }

}

const onChangeRequest = (requestData : Object | null) => 
{
    Inertia.get(
        route('customers'),
        {
            'search'       : requestData.search ?? null,
            'sizePerPage'  : requestData.sizePerPage ?? 10,
            'showPage'     : requestData.showPage ?? 1,
            'sortByColumn' : requestData.sortBy ?? 'name',
            'sortDirection': requestData.sortDirection ?? 'asc',
        },
        {
            preserveState: true,
            replace: true
        }
    ); 
};
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
            <form>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white" id="basic-addon1">
                        <i class="bi bi-eye-fill"></i>
                    </span>
                    <select v-model="refShowItems" class="form-control">
                        <option v-for="item in optionsItemShow" :key="item.label" :selected="item.selected"
                            :value="item.value">
                            {{ item.label }}
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="ms-2">
            <button type="button" class="btn btn-primary d-flex fw-bold" data-bs-toggle="modal"
                data-bs-target="#modalCreate">
                <i class="bi bi-plus-circle fs-6"></i>
                <span class="mx-1">New Customer</span>
            </button>
        </div>
        <div class="ms-auto me-2">
            <a class="btn btn-primary d-flex align-items-center fw-bold flex-shrink-1" target="_blank"
                :href="route('customers.pdf')">
                <i class="bi bi-printer fs-6"></i>
                <span class="mx-1">
                    Print
                </span>
            </a>
        </div>

        <div>
            <form>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white" id="basic-addon1">
                        <i class="bi bi-search fs-6"></i>
                    </span>
                    <input v-model="refSearchQuery" type="text" class="form-control" placeholder="Search"
                        aria-label="Search" aria-describedby="basic-addon1">
                </div>
            </form>
        </div>
    </div>

    <div class="container-fluid my-3">
        <table class="table table-responsive table-hover shadow table-light  table-striped table-bordered align-middle">
            <thead class="bg-white text-secondary">
                <tr>
                    <th></th>
                    <th class="cursor-pointer" @click="sortColumn('name')">
                        <div class="d-flex justify-content-between">
                            <span>
                                Customer Name
                            </span>
                            <template v-if="refSortBy == 'name'">
                                <i v-if="refSortDirection == 'asc'" class="bi bi-chevron-double-up">
                                </i>
                                <i v-else class="bi bi-chevron-double-down">
                                </i>
                            </template>
                            <template v-else>
                                <i class="bi bi-chevron-bar-contract">
                                </i>
                            </template>
                        </div>
                    </th>
                    <th class="cursor-pointer" @click="sortColumn('contact_person')">
                        <div class="d-flex justify-content-between">
                            <span>
                                Contact Person
                            </span>
                            <template v-if="refSortBy == 'contact_person'">
                                <i v-if="refSortDirection == 'asc'" class="bi bi-chevron-double-up">
                                </i>
                                <i v-else class="bi bi-chevron-double-down">
                                </i>
                            </template>
                            <template v-else>
                                <i class="bi bi-chevron-bar-contract">
                                </i>
                            </template>
                        </div>
                    </th>
                    <th class="cursor-pointer" @click="sortColumn('address')">
                        <div class="d-flex justify-content-between">
                            <span>
                                Address
                            </span>
                            <template v-if="refSortBy == 'address'">
                                <i v-if="refSortDirection == 'asc'" class="bi bi-chevron-double-up">
                                </i>
                                <i v-else class="bi bi-chevron-double-down">
                                </i>
                            </template>
                            <template v-else>
                                <i class="bi bi-chevron-bar-contract">
                                </i>
                            </template>
                        </div>
                    </th>
                    <th class="cursor-pointer" @click="sortColumn('contact_number')">
                        <div class="d-flex justify-content-between">
                            <span>
                                Contact Number
                            </span>
                            <template v-if="refSortBy == 'contact_number'">
                                <i v-if="refSortDirection == 'asc'" class="bi bi-chevron-double-up">
                                </i>
                                <i v-else class="bi bi-chevron-double-down">
                                </i>
                            </template>
                            <template v-else>
                                <i class="bi bi-chevron-bar-contract">
                                </i>
                            </template>
                        </div>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in customers.data" :key="item?.slug">
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
                        <Link :href="route('customers.destroy', {slug : item.slug})" method="DELETE"
                            class="btn btn-danger btn-sm" as="button">
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
            Showing {{ dataMeta.from }} - {{ dataMeta.to }} of {{ dataMeta.of }} Items
        </div>

        <!-- PAGINATION HERE -->
        <div>
            <ComponentAppPagination :totalPages="dataMeta.pages" :perPage="refShowItems" :currentPage="refCurrentPage"
                :maxVisibleButtons="refVisiblePages" @onPageChange="onPageChange" />
        </div>
    </div>

    <!-- Modal -->
    <Teleport to="body">
        <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <ComponentCustomerModalContentCreate />
        </div>
    </Teleport>

</template>