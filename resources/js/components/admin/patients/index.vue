<script setup>
import Base from "../layouts/base.vue";
import { onMounted, ref } from "vue";
let patients = ref([]);
const showModal = ref(false);
const hideModal = ref(true);
const editMode = ref(false);
let form = ref({
  name: "",
  dob: "",
  mobile: "",
  address: "",
});
onMounted(async () => {
  getPatients();
});

const getPatients = async () => {
  let response = await axios.get("/api/get_all_patients");
  console.log("response", response);
  patients.value = response.data.patients;
};

const openModal = () => {
  showModal.value = !showModal.value;
};

const closeModal = () => {
  showModal.value = !hideModal.value;
  form.value = {};
  editMode.value = false;
};
const editModal = (patient) => {
  editMode.value = true;
  showModal.value = !showModal.value;
  form.value = patient;
};
//   .post(`/api/update_about/${form.value.id}`, form.value)
const createPatient = async () => {
  await axios.post("/api/create_patient", form.value).then((response) => {
    getPatients();
    closeModal();
    toast.fire({
      icon: "success",
      title: "Patient add Successfully",
    });
  });
};

const updatePatient = async () => {
  await axios
    .post("/api/update_patient/" + form.value.id, form.value)
    .then(() => {
      getPatients();
      closeModal();
      toast.fire({
        icon: "success",
        title: "Patient update successfully",
      });
    });
};
const deletePatient = (id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You can't go back",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      axios.post("/api/delete_patient/" + id).then(() => {
        Swal.fire("Delete", "Patient delete successfully", "success");
        getPatients();
      });
    }
  });
};
</script>
<template>
  <Base />
  <main class="main">
    <!-- Side Nav Dummy-->
    <div class="main__sideNav"></div>
    <!-- End Side Nav -->
    <!-- Main Content -->
    <div class="main__content">
      <section class="services section" id="services">
        <div class="services_container">
          <div class="titlebar">
            <div class="titlebar_item">
              <h1>Patients</h1>
            </div>
            <div class="titlebar_item">
              <div class="btn btn__open--modal" @click="openModal()">
                New Patient
              </div>
            </div>
          </div>

          <div class="table">
            <div class="table_filter">
              <span class="table_filter-Btn">
                <i class="fas fa-ellipsis-h"></i>
              </span>
              <div>
                <ul class="table_filter-list">
                  <li>
                    <p class="table_filter-link table_filter-link--active">
                      <!-- All -->
                    </p>
                  </li>
                </ul>
              </div>
            </div>

            <div class="table_search">
              <!-- <div class="table_search-wrapper">
                                <select
                                    class="table_search-select"
                                    name=""
                                    id=""
                                >
                                    <option value="">Filter</option>
                                </select>
                            </div> -->
              <!--      <div class="relative">
                                <i
                                    class="table_search-input--icon fas fa-search"
                                ></i>
                                <input
                                    class="table_search--input"
                                    type="text"
                                    placeholder="Search Service"
                                />
                            </div> -->
            </div>

            <div class="service_table-heading">
              <p>Name</p>
              <p>Date of Birth</p>
              <p>Mobile</p>
              <p>Address</p>
              <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
              class="service_table-items"
              v-for="item in patients"
              :key="item.id"
              v-if="patients.length > 0"
            >
              <p>{{ item.name }}</p>
              <p>{{ item.dob }}</p>
              <p>{{ item.mobile }}</p>
              <p>{{ item.address }}</p>
              <div>
                <button class="btn-icon success" @click="editModal(item)">
                  <i class="fas fa-pencil-alt"></i>
                </button>
                <button class="btn-icon danger" @click="deletePatient(item.id)">
                  <i class="far fa-trash-alt"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-------------- SERVICES MODAL ---------------->
        <div class="modal main__modal" :class="{ show: showModal }">
          <div class="modal__content">
            <span class="modal__close btn__close--modal" @click="closeModal()"
              >×</span
            >
            <h3 class="modal__title" v-show="editMode == false">Add Patient</h3>
            <h3 class="modal__title" v-show="editMode == true">
              Update Patient
            </h3>
            <hr class="modal_line" />
            <br />

            <form
              @submit.prevent="
                editMode==true ? updatePatient() : createPatient()
              "
            >
              <div>

                <p>Patient Name</p>
                <input type="text" class="input" v-model="form.name" />
                <p>Date of Birth</p>
                <input type="date" class="input" v-model="form.dob" />
                <p>Mobile</p>
                <input cols="10" rows="5" v-model="form.mobile" />
                <p>Address</p>
                <input cols="10" rows="5" v-model="form.address" />
              </div>
              <br />
              <hr class="modal_line" />
              <div class="model__footer">
                <button
                  class="mr-2 btn btn__close--modal"
                  @click="closeModal()"
                >
                  Cancel
                </button>
                <button class="btn btn-secondary" v-show="editMode == false">
                  Save
                </button>
                <button class="btn btn-secondary" v-show="editMode == true">
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>
