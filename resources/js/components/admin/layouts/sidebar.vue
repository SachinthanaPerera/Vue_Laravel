<template>
  <!-- Nav Main -->
        <nav class="nav">
            <div class="nav_wrapper">
                <span class="nav_close">
                    <i class="fas fa-window-close"></i>
                </span>
                <ul class="nav_list">
                    <li class="nav_item">
                        <router-link class="nav_link nav__active" to="/admin/home">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Home
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link class="nav_link " to="/admin/about">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-user nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                My Profile
                            </span>
                        </router-link>
                    </li>
                    <li class="nav_item">
                        <router-link class="nav_link " to="/admin/patients">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-users nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Patients
                            </span>
                        </router-link>
                    </li>
                      <li class="nav_item">
                        <router-link class="nav_link " to="/admin/prescriptions">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-file-prescription nav__link--icon"> </i>
                            </span>
                            <span class="nav_link--span--navname">
                                Prescriptions
                            </span>
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Nav Main -->
</template>
