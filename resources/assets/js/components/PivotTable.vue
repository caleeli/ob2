<template>
    <table :id="id">
        <tr v-for="col in cols">
            <td v-for="row in rows" :colspan="row.span">

            </td>
            <td v-for="x in xs" :colspan="col.span">
                {{x}}
            </td>
        </tr>
        <tr v-for="y in ys">
            <td v-for="row in rows" :colspan="row.span">
                {{x}}
            </td>
        </tr>
    </table>
</template>

<script>
import BaseComponent from './BaseComponent.js';
export default BaseComponent.extend({
    props: [
        "model",
        "children",
        "id",
        "refreshWith",
    ],
    data:function() {
        return {
        };
    },
    computed: {
    },
    methods: {
        refresh: function () {
            var self = this;
            self.list.length = 0;
            self.model.$select(function (data) {
                data.data.forEach(function (row) {
                    self.list.push(row);
                });
            });
        },
    }
});
</script>
