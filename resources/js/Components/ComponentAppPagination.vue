<script setup lang="ts">

import { computed, defineProps, defineEmits } from "vue";

interface Props 
{
    maxVisibleButtons?: number,
    totalPages        : number
    perPage           : number
    currentPage       : number
}; 

const props = defineProps<Props>(); 

const emit = defineEmits<
    {
        (
            e   : 'onPageChange',
            page: number
        ) : void
    }
>(); 


//! PAGE CONTROL
const onClickFirstPage = () => 
{
    emit('onPageChange', 1); 
};

const onClickPreviousPage = () => 
{
    let value : number = 0; 

    if((props.currentPage - 1) <= 0)
    {
        value = 1; 
    }
    else 
    {
        value = props.currentPage - 1; 
    }

    emit('onPageChange', value);
};

const onClickPage = (page) => 
{
    emit('onPageChange', page);
};

const onClickNextPage = () => 
{
    let value : number = 0; 

    if((props.currentPage + 1) >= props.totalPages)
    {
        value = props.totalPages; 
    }
    else 
    {
        value = props.currentPage + 1; 
    }

    emit('onPageChange', value);
};

const onClickLastPage = () => 
{
    emit('onPageChange', props.totalPages); 
};

const isInFirstPage = computed(() => 
    {
        return props.currentPage == 1; 
    }
);

const isInLastPage = computed(() => 
    {
        
        return props.currentPage == props.totalPages;     
    }
); 

const startPage = computed(() => 
    {
        //! When on the first page
        if (props.currentPage === 1) 
        {
            return 1;
        }

        //! When on the last page
        if (props.currentPage === props.totalPages) 
        {
            const start = props.totalPages - (props.maxVisibleButtons - 1);
            if (start === 0) 
            {
                return 1;
            } 
            else 
            {
                return start
            }
        }

        if( (props.currentPage + 1) > props.maxVisibleButtons )
        {
            return (props.maxVisibleButtons - props.currentPage) + 2;
        }

        return 1;
    }
); 

const pages = computed(() => 
    {
        const range = [];
        
        for (
            let i = 1;
            i <= Math.min(props.maxVisibleButtons, props.totalPages);
            i++
        ) 
        {
            const increase = props.currentPage + 1 > props.maxVisibleButtons ? props.currentPage - props.maxVisibleButtons : 0; 

            range.push(
                {
                    name      : i + increase,
                    isDisabled: i + increase === props.currentPage
                }
            );
        } 
        
        return range;
    }
); 

</script>

<style scoped lang="scss">
    .page-item 
    {
        cursor:pointer;
    }
</style>

<template>
    <ul>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <!-- PREVIOUS CONTROLS-->
                <li 
                    :class="[
                        'page-item',
                        isInFirstPage ? 'disabled' : ''
                    ]"
                    @click="onClickFirstPage"
                >
                    <a class="page-link">First</a>
                </li>
                <li 
                    :class="[
                        'page-item',
                        isInFirstPage ? 'disabled' : ''
                    ]"
                    @click="onClickPreviousPage"
                >
                    <a class="page-link">Previous</a>
                </li>                

                <!-- PAGE CONTROLS-->
                <li 
                    v-for="page in pages" 
                    :class="[ 
                        'page-item',
                        props.currentPage === page.name ? 'active' : '', 
                    ]" 
                    :key="page.name"
                    @click="onClickPage(page.name)"
                >
                    <a class="page-link">
                        {{ page.name }}
                    </a>
                </li>

                <!-- NEXT CONTROLS-->
                <li 
                    :class="[
                        'page-item',
                        isInLastPage ? 'disabled' : ''
                    ]"
                    @click="onClickNextPage"
                >
                    <a class="page-link">Next</a>
                </li>
                <li 
                    :class="[
                        'page-item',
                        isInLastPage ? 'disabled' : ''
                    ]"
                    @click="onClickLastPage"
                >
                    <a class="page-link">Last</a>
                </li>
            </ul>
        </nav>
    </ul>
</template>
