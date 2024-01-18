<?php

class Navbar
{
    public array $tabs = [
        'chambres' => [
            'href' => '/admin/chambres.php',
            'label' => 'Chambres',
            'icon' => 'fa-bed'
        ],
        'utilisateurs' => [
            'href' => '/admin/utilisateurs.php',
            'label' => 'Utilisateurs',
            'icon' => 'fa-users'
        ],
        'reservations' => [
            'href' => '/admin/reservations.php',
            'label' => 'Réservations',
            'icon' => 'fa-file-signature'
        ],
    ];

    public function render(string $activeTab): string
    {
        $content = <<<EOT
        <div class="border-bottom">
            <div class="container">
                <ul class="nav nav-tabs nav-container">
        EOT;

        foreach ($this->tabs as $key => $tab) {
            $content .= $this->getNavbarItem($key, $tab, $activeTab);
        }

        $content .= <<<EOT
                </ul>
            </div>
        </div>
        EOT;

        return $content;
    }

    public function getNavbarItem(string $key, array $tab, $activeTab): string
    {
        $activeClass = $key === $activeTab ? ' active' : '';
        $label = $tab['label'];
        $icon = $tab['icon'];
        $href = $tab['href'];

        $content = <<<EOT
        <li class="nav-item">
            <a href="$href" class="nav-link$activeClass">
                <i class="fa-solid $icon"></i>
                $label
            </a>
        </li>
        EOT;

        return $content;
    }
}

function getNavbarItem(string $tabName, string $activeTab): string {
    $active = $tabName === $activeTab ? ' active' : '';
    $content = <<<EOT
    <li class="nav-item">
        <a href="/admin/chambres.php" class="nav-link$active">
            Chambres
        </a>
    </li>
    EOT;

    return $content;
}