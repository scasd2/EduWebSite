<?php
	namespace PHPSTORM_META {
	/** @noinspection PhpUnusedLocalVariableInspection */
	/** @noinspection PhpIllegalArrayKeyTypeInspection */
	$STATIC_METHOD_TYPES = [

		\D('') => [
			'Model' instanceof Admin\Model\ModelModel,
			'Attribute' instanceof Admin\Model\AttributeModel,
			'AuthRule' instanceof Admin\Model\AuthRuleModel,
			'AuthGroup' instanceof Admin\Model\AuthGroupModel,
			'File' instanceof Home\Model\FileModel,
			'Channel' instanceof Home\Model\ChannelModel,
			'Menu' instanceof Admin\Model\MenuModel,
			'Addons' instanceof Admin\Model\AddonsModel,
			'Picture' instanceof Admin\Model\PictureModel,
			'Mongo' instanceof Think\Model\MongoModel,
			'Tree' instanceof Common\Model\TreeModel,
			'Action' instanceof Admin\Model\ActionModel,
			'Hooks' instanceof Admin\Model\HooksModel,
			'Config' instanceof Admin\Model\ConfigModel,
			'UcenterMember' instanceof User\Model\UcenterMemberModel,
			'Document' instanceof Home\Model\DocumentModel,
			'Relation' instanceof Think\Model\RelationModel,
			'Category' instanceof Home\Model\CategoryModel,
			'Member' instanceof Home\Model\MemberModel,
			'Url' instanceof Admin\Model\UrlModel,
			'Attachment' instanceof Addons\Attachment\Model\AttachmentModel,
			'Adv' instanceof Think\Model\AdvModel,
			'View' instanceof Think\Model\ViewModel,
		],
		\DL('') => [
			'ArticleLogic' instanceof Home\Logic\ArticleLogic,
			'BaseLogic' instanceof Home\Logic\BaseLogic,
			'DownloadLogic' instanceof Home\Logic\DownloadLogic,
		],
	];
}