<template>
    <div>
        <b-tabs content-class="mt-3">
            <b-tab v-for="tab in tabs" :key="tab.uuid" :title="tab.name">

                <b-table striped small :items="getItems(tab)" :fields="fields">
                    <template v-slot:cell(actions)="row">
                        <b-button size="sm" @click="row.toggleDetails">
                            {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                        </b-button>
                    </template>
                    <template v-slot:row-details="row">
                        <b-card>
                            <ul>
                                <li v-for="metric in row.item.metrics" :key="metric.id">
                                    {{ metric.key }}: {{ metric.value }}{{ metric.unit }}
                                </li>
                            </ul>
                        </b-card>
                    </template>
                </b-table>

            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tabs: this.getTabs(window.canaryGlobals.data),
                items: [],
                fields: [
                    { key: 'counter.name', label: 'Counter', sortable: true, sortDirection: 'desc' },
                    { key: 'client_name', sortable: true },
                    { key: 'status_code', label: 'Status', sortable: true, class: 'text-center' },
                    { key: 'status_remark', sortable: true },
                    { key: 'generated_at', sortable: true },
                    { key: 'created_at', sortable: true },
                    { key: 'actions', label: 'Actions' }
                ],
            }
        },
        methods: {
            getTabs(data) {
                let tabs = [];
                data.forEach(app => {
                    app.counters.forEach(counter => {
                        tabs.push({
                            name: app.name + ': ' + counter.name,
                            uuid: app.uuid,
                            counter: counter.name
                        })
                    });
                });
                return tabs;
            },
            getItems(tab) {
                let app = window.canaryGlobals.data.find(app => app.uuid === tab.uuid),
                    counter = app.counters.find(counter => counter.name === tab.counter);
                return counter.events
            }
        }
    }
</script>
