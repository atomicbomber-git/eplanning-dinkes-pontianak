<template>
    <div class="container">
        <form action="">

            <table class="table table-sm table-striped table-bordered">
                <thead class="thead thead-dark">
                <tr>
                    <th class="align-middle text-center"> No</th>
                    <th class="align-middle text-center"> Upaya Kesehatan</th>
                    <th class="align-middle text-center"> Kegiatan</th>
                    <th class="align-middle text-center"> Tujuan</th>
                    <th class="align-middle text-center"> Sasaran</th>
                    <th class="align-middle text-center"> Target Sasaran</th>
                    <th class="align-middle text-center"> Penanggung Jawab</th>
                    <th class="align-middle text-center"> Volume Kegiatan</th>
                    <th class="align-middle text-center"> Jadwal</th>
                    <th class="align-middle text-center"> Rincian Pelaksanaan</th>
                    <th class="align-middle text-center"> Lokasi Pelaksanaan</th>
                    <th class="align-middle text-center"> Biaya</th>
                </tr>
                </thead>

                <tbody>
                    <template v-for="unit_puskesmas in unit_puskesmas_list">
                        <tr :key="`row_unit_puskesmas_${unit_puskesmas.id}`">
                            <td class="font-weight-bold" colspan="12">
                                {{ unit_puskesmas.nama }}
                            </td>
                        </tr>

                        <tr :key="`row_ctrl_unit_puskesmas_${unit_puskesmas.id}`">
                           <td class="text-right" colspan="12">
                               <button class="btn btn-info btn-sm" type="button">
                                   Tambah Item Kegiatan
                                   <i class="fas fa-plus"></i>
                               </button>
                           </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            unit_puskesmas_list: Array,
        },

        data() {
            return {
                m_unit_puskesmas_list: this.unit_puskesmas_list.map(unit_puskesmas => ({
                    ...unit_puskesmas,
                    items: []
                }))
            }
        },

        methods: {
            onAddItemButtonClick() {

            }
        }
    }
</script>
