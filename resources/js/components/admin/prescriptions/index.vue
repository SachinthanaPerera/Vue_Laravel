<script setup>
import Base from "../layouts/base.vue";
import { onMounted, ref } from "vue";
let prescriptions = ref([]);
let patients = ref([]);
const showModal = ref(false);
const hideModal = ref(true);
const editMode = ref(false);
let form = ref({
  name: "",
  patient_id: "",
  prescription: "",
  note: "",
});
onMounted(async () => {
  getPrescriptions();
  getPatients();
});

const getPrescriptions = async () => {
  let response = await axios.get("/api/get_all_prescriptions");
  console.log("response", response);
  prescriptions.value = response.data.prescriptions;
};
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
const createPrescription = async () => {
  await axios.post("/api/create_prescription", form.value).then((response) => {
    getPrescriptions();
    closeModal();
    toast.fire({
      icon: "success",
      title: "Prescription add Successfully",
    });
  });
};

/* const updatePatient = async () => {
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
}; */
const deletePrescription = (id) => {
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
      axios.post("/api/delete_prescription/" + id).then(() => {
        Swal.fire("Delete", "Prescription delete successfully", "success");
        getPrescriptions();
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
              <h1>Prescriptions</h1>
            </div>
            <div class="titlebar_item">
              <div class="btn btn__open--modal" @click="openModal()">
                New Prescription
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

            <div class="skill_table-heading">
              <p>Patient Name</p>
              <p>Prescription</p>
              <p>Note</p>
              <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
              class="skill_table-items"
              v-for="item in prescriptions"
              :key="item.id"
              v-if="prescriptions.length > 0"
            >
              <p>{{ item.name }}</p>
              <p>{{ item.prescription }}</p>
              <p>{{ item.note }}</p>
              <div>
                <button class="btn-icon danger" @click="deletePrescription(item.id)">
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
            <h3 class="modal__title" v-show="editMode == false">
              Add Prescription
            </h3>
            <h3 class="modal__title" v-show="editMode == true">
              Update Prescription
            </h3>
            <hr class="modal_line" />
            <br />

            <form @submit.prevent="createPrescription()">
              <div>
                <p>Patient Name</p>
                <select class="inputSelect"  v-model="form.patient_id">
              <option v-for="item in patients"
              :key="item.id" :value="item.id">{{ item.name }} </option></select>
                <!-- <input type="text" class="input" v-model="form.name" /> -->
                <p>Prescription</p>
                <input type="text" class="input" v-model="form.prescription" />
                <p>Note</p>
                <textarea cols="10" rows="5" v-model="form.note"></textarea>
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
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>
