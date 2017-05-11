<?php
namespace App\Repositories;
use App\Model\FriendLink;
/**
 * Class FriendLinkRepository
 * @package App\Repositories
 */
class FriendLinkRepository
{
    use BaseRepository;

    /**
     * 友情链接模型
     *
     * @var FriendLink
     * @author wutao
     */
    protected $friendLink;

    /**
     * 模型注入
     *
     * FriendLinkRepository constructor.
     * @param $friendLink
     * @author
     */
    public function __construct(FriendLink $friendLink)
    {
        $this->model = $friendLink;
    }
}