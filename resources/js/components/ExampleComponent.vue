<template>
    <div>
        <b-tabs content-class="mt-3">
            <b-tab v-for="(tab, i) in tabs" :key="i" :active="i === getTabIndex()" :title="tab.name" @click.prevent="() => setTabHash(tab.counter)">

                <b-table striped small :items="getItems(tab)" :fields="fields">
                    <template v-slot:cell(status)="row">
                        <span :class="'badge badge-' + getStatus(row.item)">{{ getStatus(row.item) }}</span>
                    </template>
                    <template v-slot:cell(client)="row">
                        <b>{{ row.item.client_name }}</b> <small>({{ row.item.client_id }})</small>
                    </template>
                    <template v-slot:cell(actions)="row">
                        <b-button size="sm" @click="row.toggleDetails">
                            {{ row.detailsShowing ? 'Hide' : 'Show' }} metrics
                        </b-button>
                    </template>
                    <template v-slot:row-details="row">
                        <b-card>
                            <ul>
                                <li v-for="metric in row.item.metrics" :key="metric.id">
                                    {{ metric.key }}: <b>{{ metric.value }}</b>{{ metric.unit }}
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
                levels: window.canaryGlobals.levels,
                items: [],
                fields: [
                    {key: 'status', sortable: true, class: 'text-center'},
                    {key: 'client', sortable: true},
                    {key: 'status_remark'},
                    {key: 'generated_at', sortable: true},
                    {key: 'created_at', sortable: true},
                    {key: 'actions', label: ''}
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

                return counter.events.sort((a, b) => a.created_at < b.created_at)
            },
            getStatus(item) {
                return this.levels[item.status_code];
            },
            setTabHash(id) {
                window.location.hash = '#' + id;
            },
            getTabIndex() {
                const tabs = this.getTabs(window.canaryGlobals.data),
                    counter = window.location.hash.replace('#', ''),
                    idx = (tabs || this.tabs).findIndex(tab => tab.counter === counter);

                return idx > 0 ? idx : 0;
            }
        }
    }
</script>
