<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> {{ title }}

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-default btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <p><strong>Sekolah:</strong> {{ sub_title }}</p>

      <div class="d-flex justify-content-between align-items-center">
        <vuetable-filter-bar></vuetable-filter-bar>
      </div>

      <div style="margin:20px 0;">
        <div v-if="loading" class="d-flex justify-content-start align-items-center">
          <i class="fa fa-refresh fa-spin fa-fw"></i>
          <span>Loading...</span>
        </div>
      </div>

      <div class="table-responsive">
        <vuetable ref="vuetable"
          :api-url="api_url"
          :fields="fields"
          :sort-order="sortOrder"
          :css="css.table"
          pagination-path=""
          :per-page="10"
          :append-params="moreParams"
          @vuetable:pagination-data="onPaginationData"
          @vuetable:loading="onLoading"
          @vuetable:loaded="onLoaded">
          <template slot="actions" slot-scope="props">
            <div class="btn-group pull-right" role="group" style="display:flex;">
              <button class="btn btn-primary btn-sm" role="button" @click="createRow(props.rowData)">
                <span class="fa fa-plus"></span> Terima
              </button>
              <!-- <button class="btn btn-info btn-sm" role="button" @click="viewRow(props.rowData)">
                <span class="fa fa-eye"></span>
              </button> -->
              <!-- <button class="btn btn-warning btn-sm" role="button" @click="editRow(props.rowData)">
                <span class="fa fa-pencil"></span>
              </button> -->
              <!-- <button class="btn btn-danger btn-sm" role="button" @click="deleteRow(props.rowData)">
                <span class="fa fa-trash"></span>
              </button> -->
            </div>
          </template>
        </vuetable>
      </div>

      <div class="d-flex justify-content-between align-items-center">
        <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
        <vuetable-pagination ref="pagination"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage">
        </vuetable-pagination>
      </div>
    </div>
  </div>
</template>

<style>
.vuetable-th-sequence{
  width: 1px;
}
.vuetable-th-slot-actions {
  width: 1px;
  white-space: normal;
}
</style>

<script>
import swal from 'sweetalert2';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';

export default {
  components: {
    VuetablePaginationInfo,
  },
  data() {
    return {
      loading: true,
      title: 'View Hasil Seleksi',
      sub_title: '',
      api_url: '/api/hasil-seleksi/'+this.$route.params.id+'/'+this.$route.params.track,
      fields: [
        {
          name: '__sequence',
          title: '#',
          titleClass: 'center aligned',
          dataClass: 'right aligned',
        },
        {
          name: 'nomor_un',
          title: 'Nomor UN',
          sortField: 'nomor_un',
          titleClass: 'center aligned',
        },
        {
          name: 'nama_siswa',
          title: 'Nama Siswa',
          sortField: 'nama_siswa',
          titleClass: 'center aligned',
        },
        {
          name: 'akademik.bahasa_indonesia',
          title: 'B.Ind',
          // sortField: 'akademik.bahasa_indonesia',
          titleClass: 'center aligned',
        },
        {
          name: 'akademik.bahasa_inggris',
          title: 'B.Ing',
          // sortField: 'akademik.bahasa_inggris',
          titleClass: 'center aligned',
        },
        {
          name: 'akademik.matematika',
          title: 'MTK',
          // sortField: 'akademik.matematika',
          titleClass: 'center aligned',
        },
        {
          name: 'akademik.ipa',
          title: 'IPA',
          // sortField: 'akademik.ipa',
          titleClass: 'center aligned',
        },
        {
          name: 'nilai.akademik',
          title: 'Akademik',
          // sortField: 'nilai.akademik',
          titleClass: 'center aligned',
        },
        {
          name: '__slot:actions',
          title: 'Actions',
          titleClass: 'center aligned',
          dataClass: 'center aligned',
        },
      ],
      sortOrder: [{
        field: 'nama_siswa',
        direction: 'asc'
      }],
      moreParams: {
        //
      },
      css: {
        table: {
          tableClass: 'table table-hover',
          ascendingIcon: 'fa fa-chevron-up',
          descendingIcon: 'fa fa-chevron-down'
        },
        pagination: {
          wrapperClass: 'vuetable-pagination btn-group',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'btn btn-light',
          linkClass: 'btn btn-light',
          icons: {
            first: 'fa fa-angle-double-left',
            prev: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            last: 'fa fa-angle-double-right'
          }
        }
      },
    }
  },
  mounted() {
    let app = this;

    axios.get('api/sekolah/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true && response.data.error == false) {
          this.sub_title = response.data.sekolah.nama;
        } else {
          swal(
            'Failed',
            'Oops... '+response.data.message,
            'error'
          );

          app.back();
        }
      })
      .catch(function(response) {
        swal(
          'Not Found',
          'Oops... Your page is not found.',
          'error'
        );

        app.back();
      });
  },
  methods: {
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    onLoading: function() {
      this.loading = true;
    },
    onLoaded: function() {
      this.loading = false;
    },
    createRow(rowData) {
      window.location = '#/admin/seleksi/create/'+rowData.id;
    },
    viewRow(rowData) {
      window.location = '#/admin/seleksi/'+rowData.id;
    },
    viewRowGeneral(rowData) {
      window.location = '#/admin/seleksi/'+rowData.id+'/umum';
    },
    viewRowAchievement(rowData) {
      window.location = '#/admin/seleksi/'+rowData.id+'/prestasi';
    },
    editRow(rowData) {
      window.location = '#/admin/seleksi/'+rowData.id+'/edit';
    },
    deleteRow(rowData) {
      let app = this;

      swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          axios.delete('/api/seleksi/'+rowData.id)
            .then(function(response) {
              if (response.data.status == true && response.data.error == false) {
                app.$refs.vuetable.reload();

                swal(
                  'Deleted',
                  'Yeah!!! Your data has been deleted.',
                  'success',
                );
              } else {
                swal(
                  'Failed',
                  'Oops... '+response.data.message,
                  'error',
                );
              }
            })
            .catch(function(response) {
              swal(
                'Not Found',
                'Oops... Your page is not found.',
                'error',
              );
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal(
            'Cancelled',
            'Your data is safe.',
            'error',
          );
        }
      });
    },
    back() {
      window.location = '#/admin/hasil-seleksi';
    }
  },
  events: {
    'filter-set' (filterText) {
      this.moreParams = {
        filter: filterText,
      };

      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
    'filter-reset' () {
      this.moreParams = {
        //
      };

      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
  },
}
</script>
