<?php $urls = $this->uri->segment(1); ?>
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="navbar-header">
            <a href="<?= site_url('welcome') ?>" class="navbar-brand">CV.<b>Flazz Technologies</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?= $urls == "welcome" ? "active" : null ?>">
                    <a href="<?= site_url('welcome') ?>"><i class="icon-home4"></i> Home</a>
                </li>
                <?php if (level_user() == 1) { ?>
                    <li class="<?= $urls == "unit" || $urls == "jabatan" || $urls == "karyawan" || $urls == "jenis" ? "active" : null ?> dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-gallery"></i> Master Data <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="<?= $urls == "unit" ? "active" : null ?>">
                                <a href="<?= site_url('unit') ?>">Unit Kerja</a>
                            </li>
                            <li class="<?= $urls == "jabatan" ? "active" : null ?>">
                                <a href="<?= site_url('jabatan') ?>">Jabatan</a>
                            </li>
                            <li class="<?= $urls == "karyawan" ? "active" : null ?>">
                                <a href="<?= site_url('karyawan') ?>">Karyawan</a>
                            </li>
                            <li class="<?= $urls == "jenis" ? "active" : null ?>">
                                <a href="<?= site_url('jenis') ?>">Jenis Cuti</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= $urls == "jadwal" ? "active" : null ?>">
                        <a href="<?= site_url('jadwal') ?>"><i class="icon-calendar2"></i> Jadwal</a>
                    </li>
                    <li class="<?= $urls == "absensi" ? "active" : null ?>">
                        <a href="<?= site_url('absensi') ?>"><i class="icon-clipboard5"></i> Absensi</a>
                    </li>
                    <li class="<?= $urls == "cuti" ? "active" : null ?>">
                        <a href="<?= site_url('cuti') ?>"><i class="icon-clipboard5"></i> Pengajuan Cuti</a>
                    </li>
                    <li class="<?= $urls == "laporan" ? "active" : null ?>">
                        <a href="<?= site_url('laporan') ?>"><i class="icon-file-presentation2"></i> Laporan</a>
                    </li>
                <?php } else if (level_user() == 2) { ?>
                    <li class="<?= $urls == "jadwal" ? "active" : null ?>">
                        <a href="<?= site_url('jadwal') ?>"><i class="icon-calendar2"></i> Jadwal</a>
                    </li>
                    <li class="<?= $urls == "absensi" ? "active" : null ?>">
                        <a href="<?= site_url('absensi') ?>"><i class="icon-clipboard5"></i> Absensi</a>
                    </li>
                    <li class="<?= $urls == "cuti" ? "active" : null ?>">
                        <a href="<?= site_url('cuti') ?>"><i class="icon-clipboard5"></i> Pengajuan Cuti</a>
                    </li>
                <?php } else if (level_user() == 3) { ?>
                    <li class="<?= $urls == "karyawan" ? "active" : null ?>">
                        <a href="<?= site_url('karyawan') ?>"><i class="icon-users4"></i> Karyawan</a>
                    </li>
                    <li class="<?= $urls == "jadwal" ? "active" : null ?>">
                        <a href="<?= site_url('jadwal') ?>"><i class="icon-calendar2"></i> Jadwal</a>
                    </li>
                    <li class="<?= $urls == "cuti" ? "active" : null ?>">
                        <a href="<?= site_url('cuti') ?>"><i class="icon-clipboard5"></i> Pengajuan Cuti</a>
                    </li>
                    <li class="<?= $urls == "laporan" ? "active" : null ?>">
                        <a href="<?= site_url('laporan') ?>"><i class="icon-file-presentation2"></i> Laporan</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= assets() ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= profil_user() ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?= assets() ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                                <?= profil_user() ?>
                                <small><?= level_user() == 1 ? 'Admin' : (level_user() == 2 ? 'Karyawan' : 'Pimpinan') ?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= site_url('logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown notifications-menu bg-red">
                    <a href="<?= site_url('logout') ?>"><i class="icon-switch"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>