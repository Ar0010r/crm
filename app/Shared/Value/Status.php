<?php

namespace App\Shared\Value;

use App\Models\User;

class Status
{
    public const WAITING_AGREEMENT = 'Waiting agreement';
    public const NEW = 'New';
    public const READY = 'Ready';
    public const NEED_DATA = 'Need data';
    public const INFO = 'Info';
    public const BAD = 'Bad';
    public const DIED = 'Died';

    public const GREETED = 'Greeted';
    public const EXPORTED = 'Exported';

    private const WHITE_COLOR_STYLE = 'btn-white';
    private const BLUE_COLOR_STYLE = 'btn-primary';
    private const OCEAN_COLOR_STYLE = 'btn-info';
    private const YELLOW_COLOR_STYLE = 'btn-warning';
    private const RED_COLOR_STYLE = 'btn-danger';
    private const GREEN_COLOR_STYLE = 'btn-success';
    private const GREY_COLOR_STYLE = 'btn-secondary';
    private const BLACK_COLOR_STYLE = 'btn-dark';

    public const STATUSES = [
        self::NEW,
        self::WAITING_AGREEMENT,
        self::NEED_DATA,
        self::INFO,
        self::BAD,
        self::DIED,
        self::READY,

        self::GREETED,
        self::EXPORTED,
    ];

    public const All_STATUSES = [
        self::NEW => self::WHITE_COLOR_STYLE,
        self::WAITING_AGREEMENT => self::GREY_COLOR_STYLE,
        self::NEED_DATA => self::YELLOW_COLOR_STYLE,
        self::INFO => self::OCEAN_COLOR_STYLE,
        self::BAD => self::RED_COLOR_STYLE,
        self::DIED => self::BLACK_COLOR_STYLE,
        self::READY => self::GREEN_COLOR_STYLE,

        self::GREETED => self::OCEAN_COLOR_STYLE,
        self::EXPORTED => self::GREEN_COLOR_STYLE,
    ];

    public const HR_STATUSES = [
        self::NEW => self::WHITE_COLOR_STYLE,
        self::WAITING_AGREEMENT => self::GREY_COLOR_STYLE,
        self::NEED_DATA => self::YELLOW_COLOR_STYLE,
        self::INFO => self::OCEAN_COLOR_STYLE,
        self::BAD => self::RED_COLOR_STYLE,
        self::DIED => self::BLACK_COLOR_STYLE,
        self::READY => self::GREEN_COLOR_STYLE,
    ];

    public const PERSONNEL_STATUSES = [
        self::READY => self::BLUE_COLOR_STYLE,
        self::GREETED => self::OCEAN_COLOR_STYLE,
        self::EXPORTED => self::GREEN_COLOR_STYLE,
        self::DIED => self::BLACK_COLOR_STYLE,
    ];

    public static function getAvailableRoles(User $user = null): array
    {
        $user = $user ?? auth()->user();

        switch ($user->role) {
            case Role::PERSONNEL:
                return self::PERSONNEL_STATUSES;
            case Role::ADMIN:
                return self::All_STATUSES;
            default:
                return self::HR_STATUSES;
        }
    }
}
