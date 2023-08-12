<?php
namespace CleverComms\CategoryExtraDescription\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class InstallData implements InstallDataInterface

{
 protected $eav_setup;
 protected $connection;
 public function __construct(EavSetupFactory $eavSetupFactory,
	\Magento\Framework\App\ResourceConnection $connection,
	\Magento\Eav\Model\Config $eavConfig
 ) {
	 $this->eav_setup_factory = $eavSetupFactory;
	 $this->connection = $connection->getConnection();
	 $this->eav_config = $eavConfig;
 }
 public function install(
	ModuleDataSetupInterface $setup,
	ModuleContextInterface $context
 ) {
	$setup->startSetup();

	//create Category Attributes
	$this->createCategoryAttributes($setup);

	$setup->endSetup();
 }
 protected function createCategoryAttributes($setup)
 {
	$eav_setup = $this->eav_setup_factory->create(['setup' => $setup]);
	$eav_setup->addAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'extra_description',
		[
			'type' => 'text',
			'label' => 'Extra Description',
			'input' => 'textarea',
			'sort_order' => 420,
			'source' => '',
			'global' => ScopedAttributeInterface::SCOPE_STORE,
			'visible' => true,
			'required' => false,
			'user_defined' => false,
			'default' => null,
			'group' => 'General Information',
			'wysiwyg_enabled' => true,
			'is_html_allowed_on_front' => true,
			'backend' => ''
		]
	);
 }
}
