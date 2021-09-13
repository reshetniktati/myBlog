<template>
    <DxDataGrid
        :data-source="dataSource"
        key-expr="ID"
        :show-borders="true"
        :height="300"
    />
</template>
<script>

import DxDataGrid from 'devextreme-vue/data-grid';
import CustomStore from 'devextreme/data/custom_store';

let totalCountValue = null;

export default {
    name: 'UsersGrid',
    components: {
        DxDataGrid
    },
    props: {
        users: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            dataSource: new CustomStore({
                key: 'id',
                totalCount: () => totalCountValue,
                load: () => {
                    return this.users;
                },
            }),
        };
    }
};
</script>
