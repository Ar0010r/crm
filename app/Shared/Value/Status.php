<?php

namespace App\Shared\Value;

use App\Models\User;

class Status
{
    public const NEW = 'New';
    public const WAITING_AGREEMENT = 'Waiting agreement';
    public const WAITING_DATA = 'Waiting data';
    public const NEED_CALL = 'Need Call';
    public const NEED_INFO_REQUEST = 'Need info request';
    public const NO_ANSWER = 'No answer';
    public const BAD = 'Bad';
    public const READY = 'Ready';
    public const GREETED = 'Greeted';
    public const EXPORTED = 'Exported';
    public const AGREEMENT_SENT = 'Agreement sent';

    private const WHITE_COLOR_STYLE = 'btn-white';
    private const BLUE_COLOR_STYLE = 'btn-primary';
    private const OCEAN_COLOR_STYLE = 'btn-info';
    private const YELLOW_COLOR_STYLE = 'btn-warning';
    private const RED_COLOR_STYLE = 'btn-danger';
    private const GREEN_COLOR_STYLE = 'btn-success';
    private const GREY_COLOR_STYLE = 'btn-secondary';
    private const BLACK_COLOR_STYLE = 'dark-secondary';

    public const STATUSES = [
        self::NEW,
        self::WAITING_AGREEMENT,
        self::WAITING_DATA,
        self::NEED_CALL,
        self::NEED_INFO_REQUEST,
        self::NO_ANSWER,
        self::BAD,
        self::READY,
        self::GREETED,
        self::EXPORTED,
        self::AGREEMENT_SENT
    ];

    public const All_STATUSES = [
        self::NEW => self::WHITE_COLOR_STYLE,
        self::AGREEMENT_SENT =>self::OCEAN_COLOR_STYLE,
        self::WAITING_AGREEMENT => self::GREY_COLOR_STYLE,
        self::WAITING_DATA => self::GREY_COLOR_STYLE,
        self::NEED_CALL => self::OCEAN_COLOR_STYLE,
        self::NEED_INFO_REQUEST => self::OCEAN_COLOR_STYLE,
        self::NO_ANSWER => self::YELLOW_COLOR_STYLE,
        self::BAD => self::RED_COLOR_STYLE,
        self::READY => self::BLUE_COLOR_STYLE,
        self::GREETED => self::GREY_COLOR_STYLE,
        self::EXPORTED => self::GREEN_COLOR_STYLE,
    ];

    public const HR_STATUSES = [
        self::NEW => self::WHITE_COLOR_STYLE,
        self::AGREEMENT_SENT =>self::OCEAN_COLOR_STYLE,
        self::WAITING_AGREEMENT => self::GREY_COLOR_STYLE,
        self::WAITING_DATA => self::GREY_COLOR_STYLE,
        self::NEED_CALL => self::OCEAN_COLOR_STYLE,
        self::NEED_INFO_REQUEST => self::OCEAN_COLOR_STYLE,
        self::NO_ANSWER => self::YELLOW_COLOR_STYLE,
        self::BAD => self::RED_COLOR_STYLE,
        self::READY => self::BLUE_COLOR_STYLE,
    ];

    public const PERSONNEL_STATUSES = [
        self::READY => self::BLUE_COLOR_STYLE,
        self::GREETED => self::GREY_COLOR_STYLE,
        self::EXPORTED => self::GREEN_COLOR_STYLE,
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
