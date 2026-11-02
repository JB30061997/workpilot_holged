<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Activity, CalendarDays, ChevronDown, ChevronUp, CirclePlus, FileClock, PencilLine, Search, Trash2 } from 'lucide-vue-next';
import { computed, reactive, ref } from 'vue';

const props = defineProps({
    organization: Object,
    activities: Object,
    filters: Object,
    summary: Object,
    subjectTypes: Array,
});

const expandedActivityId = ref(null);
const form = reactive({
    search: props.filters?.search ?? '',
    event: props.filters?.event ?? '',
    subject_type: props.filters?.subject_type ?? '',
    date_from: props.filters?.date_from ?? '',
    date_to: props.filters?.date_to ?? '',
});

const hasFilters = computed(() => Object.values(form).some(Boolean));
const eventMeta = {
    created: { label: 'Création', icon: CirclePlus, badge: 'bg-emerald-50 text-emerald-700 ring-emerald-200', dot: 'bg-emerald-500' },
    updated: { label: 'Modification', icon: PencilLine, badge: 'bg-blue-50 text-blue-700 ring-blue-200', dot: 'bg-blue-500' },
    deleted: { label: 'Suppression', icon: Trash2, badge: 'bg-rose-50 text-rose-700 ring-rose-200', dot: 'bg-rose-500' },
};

const applyFilters = () => router.get(route('activities.index'), form, { preserveState: true, preserveScroll: true, replace: true });
const resetFilters = () => {
    Object.assign(form, { search: '', event: '', subject_type: '', date_from: '', date_to: '' });
    applyFilters();
};
const toggleDetails = (activity) => {
    expandedActivityId.value = expandedActivityId.value === activity.id ? null : activity.id;
};
const formatDateTime = (value) => new Intl.DateTimeFormat('fr-FR', {
    dateStyle: 'medium',
    timeStyle: 'short',
}).format(new Date(value));
const formatField = (field) => field.replaceAll('_', ' ').replace(/\b\w/g, (letter) => letter.toUpperCase());
const formatValue = (value) => {
    if (value === null || value === undefined || value === '') return '—';
    if (typeof value === 'boolean') return value ? 'Oui' : 'Non';
    if (typeof value === 'object') return JSON.stringify(value, null, 2);

    return String(value);
};
const changedFields = (activity) => [...new Set([
    ...Object.keys(activity.old_values ?? {}),
    ...Object.keys(activity.new_values ?? {}),
])];
</script>

<template>
    <Head title="Mon historique" />
    <AuthenticatedLayout>
        <div class="mx-auto grid max-w-[1500px] gap-5 px-4 py-6 sm:px-7">
            <header class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="relative px-5 py-6 sm:px-7">
                    <div class="absolute right-0 top-0 h-40 w-80 bg-gradient-to-bl from-blue-100/70 to-transparent" />
                    <div class="relative flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[.2em] text-blue-600">{{ organization.name }} · Audit personnel</p>
                            <h1 class="mt-2 text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">Mon historique</h1>
                            <p class="mt-2 max-w-2xl text-sm text-slate-500">Retrouvez toutes vos créations, modifications et suppressions dans WorkPilot.</p>
                        </div>
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-blue-50 text-blue-700"><FileClock :size="27" /></span>
                    </div>
                </div>
                <div class="grid border-t border-slate-200 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex items-center gap-3 border-b border-slate-100 p-4 sm:border-r lg:border-b-0"><span class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-600"><Activity :size="19" /></span><div><b class="block text-xl text-slate-900">{{ summary.total }}</b><small class="text-slate-500">Événements</small></div></div>
                    <div class="flex items-center gap-3 border-b border-slate-100 p-4 lg:border-b-0 lg:border-r"><span class="grid h-10 w-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><CirclePlus :size="19" /></span><div><b class="block text-xl text-slate-900">{{ summary.created }}</b><small class="text-slate-500">Créations</small></div></div>
                    <div class="flex items-center gap-3 border-b border-slate-100 p-4 sm:border-r lg:border-b-0"><span class="grid h-10 w-10 place-items-center rounded-xl bg-blue-50 text-blue-600"><PencilLine :size="19" /></span><div><b class="block text-xl text-slate-900">{{ summary.updated }}</b><small class="text-slate-500">Modifications</small></div></div>
                    <div class="flex items-center gap-3 p-4"><span class="grid h-10 w-10 place-items-center rounded-xl bg-rose-50 text-rose-600"><Trash2 :size="19" /></span><div><b class="block text-xl text-slate-900">{{ summary.deleted }}</b><small class="text-slate-500">Suppressions</small></div></div>
                </div>
            </header>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <form class="grid gap-3 border-b border-slate-200 bg-slate-50/70 p-4 md:grid-cols-2 xl:grid-cols-[minmax(240px,1.5fr)_1fr_1fr_1fr_1fr_auto]" @submit.prevent="applyFilters">
                    <label class="relative"><Search class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" :size="17" /><input v-model="form.search" type="search" class="h-11 w-full rounded-xl border-slate-200 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Rechercher une action…" /></label>
                    <select v-model="form.event" class="h-11 rounded-xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500"><option value="">Toutes les actions</option><option value="created">Créations</option><option value="updated">Modifications</option><option value="deleted">Suppressions</option></select>
                    <select v-model="form.subject_type" class="h-11 rounded-xl border-slate-200 text-sm focus:border-blue-500 focus:ring-blue-500"><option value="">Tous les éléments</option><option v-for="type in subjectTypes" :key="type.value" :value="type.value">{{ type.label }}</option></select>
                    <label class="relative"><CalendarDays class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" :size="16" /><input v-model="form.date_from" type="date" class="h-11 w-full rounded-xl border-slate-200 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500" title="Du" /></label>
                    <label class="relative"><CalendarDays class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" :size="16" /><input v-model="form.date_to" type="date" class="h-11 w-full rounded-xl border-slate-200 pl-10 text-sm focus:border-blue-500 focus:ring-blue-500" title="Au" /></label>
                    <div class="flex gap-2"><button class="h-11 rounded-xl bg-blue-600 px-4 text-sm font-bold text-white transition hover:bg-blue-700">Filtrer</button><button v-if="hasFilters" type="button" class="h-11 rounded-xl border border-slate-200 bg-white px-3 text-sm font-bold text-slate-600 hover:bg-slate-100" @click="resetFilters">Effacer</button></div>
                </form>

                <div v-if="activities.data.length" class="divide-y divide-slate-100">
                    <article v-for="item in activities.data" :key="item.id" class="relative px-4 py-4 transition hover:bg-slate-50/80 sm:px-6">
                        <div class="flex items-start gap-4">
                            <span class="relative mt-1 grid h-10 w-10 shrink-0 place-items-center rounded-full bg-white ring-1 ring-slate-200"><span class="absolute h-2.5 w-2.5 rounded-full" :class="eventMeta[item.event]?.dot || 'bg-slate-400'" /><component :is="eventMeta[item.event]?.icon || Activity" :size="18" class="opacity-0" /></span>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2"><span class="inline-flex rounded-full px-2.5 py-1 text-[10px] font-black uppercase ring-1 ring-inset" :class="eventMeta[item.event]?.badge || 'bg-slate-100 text-slate-600 ring-slate-200'">{{ eventMeta[item.event]?.label || item.event }}</span><span class="text-xs font-bold uppercase tracking-wide text-slate-400">{{ item.subject_label }}</span></div>
                                <p class="mt-2 font-bold text-slate-900">{{ item.description }}</p>
                                <div class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-slate-500"><time>{{ formatDateTime(item.created_at) }}</time><span v-if="item.ip_address">IP {{ item.ip_address }}</span><span v-if="item.metadata?.route" class="font-mono text-[10px] text-slate-400">{{ item.metadata.route }}</span></div>
                            </div>
                            <button type="button" class="inline-flex shrink-0 items-center gap-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-600 transition hover:border-blue-200 hover:text-blue-700" @click="toggleDetails(item)"><ChevronUp v-if="expandedActivityId === item.id" :size="14" /><ChevronDown v-else :size="14" /> Détails</button>
                        </div>

                        <div v-if="expandedActivityId === item.id" class="ml-14 mt-4 overflow-hidden rounded-xl border border-slate-200 bg-white">
                            <div v-if="changedFields(item).length" class="overflow-x-auto"><table class="min-w-full text-left text-xs"><thead class="bg-slate-50 text-[10px] font-black uppercase tracking-wide text-slate-500"><tr><th class="px-4 py-3">Champ</th><th class="px-4 py-3">Avant</th><th class="px-4 py-3">Après</th></tr></thead><tbody class="divide-y divide-slate-100"><tr v-for="field in changedFields(item)" :key="field"><td class="whitespace-nowrap px-4 py-3 font-bold text-slate-700">{{ formatField(field) }}</td><td class="max-w-md whitespace-pre-wrap break-words px-4 py-3 text-rose-700">{{ formatValue(item.old_values?.[field]) }}</td><td class="max-w-md whitespace-pre-wrap break-words px-4 py-3 text-emerald-700">{{ formatValue(item.new_values?.[field]) }}</td></tr></tbody></table></div>
                            <p v-else class="px-4 py-4 text-sm text-slate-500">Aucune différence détaillée disponible pour cet ancien événement.</p>
                            <div v-if="item.user_agent" class="border-t border-slate-100 bg-slate-50 px-4 py-3 text-[10px] text-slate-400">Appareil : {{ item.user_agent }}</div>
                        </div>
                    </article>
                </div>
                <div v-else class="grid place-items-center px-6 py-20 text-center"><span class="grid h-16 w-16 place-items-center rounded-2xl bg-slate-100 text-slate-400"><FileClock :size="28" /></span><h2 class="mt-4 font-black text-slate-800">Aucun événement trouvé</h2><p class="mt-1 text-sm text-slate-400">Vos prochaines actions apparaîtront automatiquement ici.</p></div>

                <footer v-if="activities.last_page > 1" class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 px-5 py-4"><p class="text-xs text-slate-500">{{ activities.from }}–{{ activities.to }} sur {{ activities.total }}</p><div class="flex flex-wrap gap-1"><Link v-for="link in activities.links" :key="link.label" :href="link.url || '#'" preserve-scroll class="grid min-h-9 min-w-9 place-items-center rounded-lg border px-2 text-xs font-bold" :class="[link.active ? 'border-blue-600 bg-blue-600 text-white' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50', !link.url ? 'pointer-events-none opacity-40' : '']" v-html="link.label" /></div></footer>
            </section>
        </div>
    </AuthenticatedLayout>
</template>
