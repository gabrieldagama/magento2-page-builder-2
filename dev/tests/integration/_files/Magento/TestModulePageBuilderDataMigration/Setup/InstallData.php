<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\TestModulePageBuilderDataMigration\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 */
class InstallData implements InstallDataInterface
{
    /**
     * Entity setup factory
     *
     * @var EntitySetupFactory
     */
    protected $entitySetupFactory;

    /**
     * @var \Magento\TestModulePageBuilderDataMigration\Model\Install
     */
    protected $installer;

    /**
     * @var \Magento\Eav\Model\Config
     */
    protected $eavConfig;

    /**
     * @var array
     */
    private static $dropTableNames = [
        'gene_bluefoot_entity_datetime',
        'gene_bluefoot_entity_decimal',
        'gene_bluefoot_entity_int',
        'gene_bluefoot_entity_text',
        'gene_bluefoot_entity_varchar',
        'gene_bluefoot_eav_attribute',
        'gene_bluefoot_entity_type',
        'gene_bluefoot_stage_template',
        'gene_bluefoot_entity'
    ];

    /**
     * InstallData constructor.
     *
     * @param EntitySetupFactory $entitySetupFactory
     * @param \Magento\TestModulePageBuilderDataMigration\Model\Install $installer
     * @param \Magento\Eav\Model\Config $eavConfig
     */
    public function __construct(
        \Magento\TestModulePageBuilderDataMigration\Setup\EntitySetupFactory $entitySetupFactory,
        \Magento\TestModulePageBuilderDataMigration\Model\Install $installer,
        \Magento\Eav\Model\Config $eavConfig
    ) {
        $this->entitySetupFactory = $entitySetupFactory;
        $this->installer = $installer;
        $this->eavConfig = $eavConfig;
    }

    /**
     * Install groups and entities
     *
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface   $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var \Magento\TestModulePageBuilderDataMigration\Setup\EntitySetup $entitySetup */
        $entitySetup = $this->entitySetupFactory->create(['setup' => $setup]);

        // Run a fresh installation if no previous version is present
        $entitySetup->installEntities();
        $entitySetup->cleanCache();

        // Clear the eavConfig cache
        $this->eavConfig->clear();

        // Install the default content blocks
        $this->installDefaultContentBlocks($setup);

        $setup->endSetup();
    }

    /**
     * Install
     *
     * @return $this
     */
    protected function installDefaultContentBlocks($setup)
    {
        $data = $this->getContentBlockData();
        $this->installer->install($data, $setup);

        return $this;
    }


    private function getContentBlockData()
    {
        return \Zend_Json::decode('
{
  "_time": "1459776414",
  "content_blocks": [
    {
      "identifier": "hr",
      "name": "Horizontal Rule",
      "content_type": "block",
      "description": "Horizontal Rule",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_hr",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Horizontal Rule",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-divider",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "structural",
      "attribute_data": {
        "attributes": [
          "color",
          "hr_height",
          "hr_width",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "color",
                "sort_order": "2"
              },
              {
                "attribute_code": "hr_height",
                "sort_order": "4"
              },
              {
                "attribute_code": "hr_width",
                "sort_order": "6"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "map",
      "name": "Map",
      "content_type": "block",
      "description": "Google Map",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_map",
      "item_view_template": "core_map",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Map",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-map",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "600",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "map",
          "map_height",
          "map_width",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "map",
                "sort_order": "2"
              },
              {
                "attribute_code": "map_height",
                "sort_order": "4"
              },
              {
                "attribute_code": "map_width",
                "sort_order": "6"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "newsletter",
      "name": "Newsletter",
      "content_type": "block",
      "description": "newsletter",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_newsletter",
      "item_view_template": "core_newsletter",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Newsletter",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-newsletter",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "500",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "button_text",
          "label",
          "placeholder",
          "title",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "button_text",
                "sort_order": "2"
              },
              {
                "attribute_code": "label",
                "sort_order": "4"
              },
              {
                "attribute_code": "placeholder",
                "sort_order": "6"
              },
              {
                "attribute_code": "title",
                "sort_order": "8"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "heading",
      "name": "Heading",
      "content_type": "block",
      "description": "Heading \/ Title block",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_heading",
      "item_view_template": "core_heading",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Heading",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-heading",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "general",
      "attribute_data": {
        "attributes": [
          "heading_type",
          "title",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "heading_type",
                "sort_order": "2"
              },
              {
                "attribute_code": "title",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "driver",
      "name": "Driver",
      "content_type": "block",
      "description": "An image based link block.",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_image",
      "item_view_template": "core_driver",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Driver",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-driver",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "150",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "image",
          "mobile_image",
          "link_text",
          "link_url",
          "target_blank",
          "alt_tag",
          "title_tag",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "Images",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "image",
                "sort_order": "2"
              },
              {
                "attribute_code": "mobile_image",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Link Information",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "link_text",
                "sort_order": "2"
              },
              {
                "attribute_code": "link_url",
                "sort_order": "4"
              },
              {
                "attribute_code": "target_blank",
                "sort_order": "6"
              }
            ]
          },
          {
            "attribute_group_name": "SEO",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "alt_tag",
                "sort_order": "2"
              },
              {
                "attribute_code": "title_tag",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "4",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "image",
      "name": "Image",
      "content_type": "block",
      "description": "An image content block",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_image",
      "item_view_template": "core_image",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Image",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-image",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "100",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "image",
          "mobile_image",
          "alt_tag",
          "title_tag",
          "has_lightbox",
          "show_caption",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "Images",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "image",
                "sort_order": "2"
              },
              {
                "attribute_code": "mobile_image",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "SEO",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "alt_tag",
                "sort_order": "2"
              },
              {
                "attribute_code": "title_tag",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Extra",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "has_lightbox",
                "sort_order": "2"
              },
              {
                "attribute_code": "show_caption",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "4",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "textarea",
      "name": "Textarea",
      "content_type": "block",
      "description": "WYSIWYG block",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_textarea",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Textarea",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-text",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "general",
      "attribute_data": {
        "attributes": [
          "textarea",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "textarea",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "product",
      "name": "Product",
      "content_type": "block",
      "description": "Single Product Widget",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_product",
      "item_view_template": "core_product",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Product",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-products",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "commerce",
      "attribute_data": {
        "attributes": [
          "product_display",
          "product_id",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "product_display",
                "sort_order": "2"
              },
              {
                "attribute_code": "product_id",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "product_list",
      "name": "Product List",
      "content_type": "block",
      "description": "List of products taken from a category",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_product_list",
      "item_view_template": "core_product_list",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Product List",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-accordian",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "commerce",
      "attribute_data": {
        "attributes": [
          "category_id",
          "hide_out_of_stock",
          "product_count",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "category_id",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Display Settings",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "hide_out_of_stock",
                "sort_order": "2"
              },
              {
                "attribute_code": "product_count",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "html",
      "name": "HTML",
      "content_type": "block",
      "description": "HTML block",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_html",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "HTML",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-special-characters",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "general",
      "attribute_data": {
        "attributes": ["html"],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "html",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "slider",
      "name": "Slider",
      "content_type": "block",
      "description": "Slider \/ Carousel",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_slider",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Slider",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-slider",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "300",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "slider_items",
          "autoplay",
          "autoplay_speed",
          "fade",
          "is_infinite",
          "show_arrows",
          "show_dots",
          "slider_advanced_settings",
          "slides_to_scroll",
          "slides_to_show",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "Slides",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "slider_items",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Settings",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "autoplay",
                "sort_order": "2"
              },
              {
                "attribute_code": "autoplay_speed",
                "sort_order": "4"
              },
              {
                "attribute_code": "fade",
                "sort_order": "6"
              },
              {
                "attribute_code": "is_infinite",
                "sort_order": "8"
              },
              {
                "attribute_code": "show_arrows",
                "sort_order": "10"
              },
              {
                "attribute_code": "show_dots",
                "sort_order": "12"
              },
              {
                "attribute_code": "slider_advanced_settings",
                "sort_order": "14"
              },
              {
                "attribute_code": "slides_to_scroll",
                "sort_order": "16"
              },
              {
                "attribute_code": "slides_to_show",
                "sort_order": "18"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "slider_item",
      "name": "Slider Item",
      "content_type": "block",
      "description": "Slide Item for slider",
      "url_key_prefix": null,
      "preview_field": "alt_tag",
      "renderer": "core_default",
      "item_view_template": "core_slider_item",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Slider Item",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-slider",
      "color": "#5284bd",
      "show_in_page_builder": "0",
      "sort_order": "0",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "image",
          "mobile_image",
          "link_url",
          "target_blank",
          "alt_tag",
          "title_tag",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "Images",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "image",
                "sort_order": "1"
              },
              {
                "attribute_code": "mobile_image",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Link",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "link_url",
                "sort_order": "1"
              },
              {
                "attribute_code": "target_blank",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "SEO",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "alt_tag",
                "sort_order": "1"
              },
              {
                "attribute_code": "title_tag",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "4",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "accordion",
      "name": "Accordion",
      "content_type": "block",
      "description": "Accordion",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_accordion",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Accordion",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-accordian",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "100",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "accordion_items",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "accordion_items",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "accordion_item",
      "name": "Accordion Item",
      "content_type": "block",
      "description": "Accordion Item",
      "url_key_prefix": null,
      "preview_field": "title",
      "renderer": "core_default",
      "item_view_template": "core_accordion_item",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Accordion Item",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-accordion",
      "color": "#5284bd",
      "show_in_page_builder": "0",
      "sort_order": "0",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "textarea",
          "title",
          "open_on_load",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "textarea",
                "sort_order": "1"
              },
              {
                "attribute_code": "title",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Extra",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "open_on_load",
                "sort_order": "1"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "static_block",
      "name": "Static Block",
      "content_type": "block",
      "description": "Static block renderer",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_static_block",
      "item_view_template": "core_static_block",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Static Block",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-block",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "300",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "block_id",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "block_id",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "search",
      "name": "Search",
      "content_type": "block",
      "description": "Catalog search widget",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_search",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Search",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-button",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "400",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "placeholder",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "placeholder",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "button_item",
      "name": "Button",
      "content_type": "block",
      "description": "Single Button",
      "url_key_prefix": null,
      "preview_field": "link_text",
      "renderer": "core_default",
      "item_view_template": "core_button_item",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Button",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-button",
      "color": "#5284bd",
      "show_in_page_builder": "0",
      "sort_order": "0",
      "group": "general",
      "attribute_data": {
        "attributes": [
          "link_text",
          "link_url",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "link_text",
                "sort_order": "1"
              },
              {
                "attribute_code": "link_url",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "buttons",
      "name": "Buttons",
      "content_type": "block",
      "description": "Button list",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_buttons",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Buttons",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-button",
      "color": "#5284bd",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "general",
      "attribute_data": {
        "attributes": [
          "button_items",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "button_items",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "tabs",
      "name": "Tabs",
      "content_type": "block",
      "description": "Tabs",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_tab",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Tabs",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-tabs",
      "color": "#779ecb",
      "show_in_page_builder": "1",
      "sort_order": "200",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "tabs_items",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "tabs_items",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "tabs_item",
      "name": "Tab",
      "content_type": "block",
      "description": "Tab",
      "url_key_prefix": null,
      "preview_field": "title",
      "renderer": "core_default",
      "item_view_template": "core_tab_item",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Tab",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-tabs",
      "color": "#779ecb",
      "show_in_page_builder": "0",
      "sort_order": "0",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "title",
          "textarea",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "title",
                "sort_order": "1"
              },
              {
                "attribute_code": "textarea",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "video",
      "name": "Video",
      "content_type": "block",
      "description": "Add a YouTube or Vimeo video",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_video",
      "item_view_template": "core_video",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Video",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-video",
      "color": "#A6C0C5",
      "show_in_page_builder": "1",
      "sort_order": "200",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "video_url",
          "video_height",
          "video_width",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "video_url",
                "sort_order": "1"
              },
              {
                "attribute_code": "video_height",
                "sort_order": "2"
              },
              {
                "attribute_code": "video_width",
                "sort_order": "3"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "anchor",
      "name": "Anchor",
      "content_type": "block",
      "description": "Anchor",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_anchor",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Anchor",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-anchor",
      "color": "#779ecb",
      "show_in_page_builder": "1",
      "sort_order": "0",
      "group": "structural",
      "attribute_data": {
        "attributes": [
          "anchor_id",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "anchor_id",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "code",
      "name": "Code",
      "content_type": "block",
      "description": "Code Block",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_code",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Code",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-code",
      "color": "#779ecb",
      "show_in_page_builder": "1",
      "sort_order": "700",
      "group": "other",
      "attribute_data": {
        "attributes": [
          "html",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "html",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "2"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "advanced_slider_item",
      "name": "Advanced Slider Item",
      "content_type": "block",
      "description": "Advanced Slider Item (has buttons, text and a title)",
      "url_key_prefix": null,
      "preview_field": "title",
      "renderer": "core_default",
      "item_view_template": "core_advanced_slider_item",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Advanced Slider Item",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-slider",
      "color": "blue",
      "show_in_page_builder": "0",
      "sort_order": "500",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "title",
          "textarea",
          "link_text",
          "link_url",
          "background_image",
          "has_overlay",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "title",
                "sort_order": "1"
              },
              {
                "attribute_code": "textarea",
                "sort_order": "2"
              },
              {
                "attribute_code": "link_text",
                "sort_order": "3"
              },
              {
                "attribute_code": "link_url",
                "sort_order": "4"
              }
            ]
          },
          {
            "attribute_group_name": "Appearance",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "background_image",
                "sort_order": "1"
              },
              {
                "attribute_code": "has_overlay",
                "sort_order": "2"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    },
    {
      "identifier": "advanced_slider",
      "name": "Advanced Slider",
      "content_type": "block",
      "description": "Advanced Slider",
      "url_key_prefix": null,
      "preview_field": null,
      "renderer": "core_default",
      "item_view_template": "core_advanced_slider",
      "list_template": null,
      "list_item_template": null,
      "item_layout_update_xml": null,
      "list_layout_update_xml": null,
      "singular_name": "Advanced Slider",
      "plural_name": null,
      "include_in_sitemap": "0",
      "searchable": "0",
      "icon_class": "icon-bluefoot-slider",
      "color": "blue",
      "show_in_page_builder": "1",
      "sort_order": "500",
      "group": "media",
      "attribute_data": {
        "attributes": [
          "advanced_slider_items",
          "fade",
          "autoplay",
          "autoplay_speed",
          "is_infinite",
          "show_arrows",
          "show_dots",
          "slider_advanced_settings",
          "css_classes"
        ],
        "groups": [
          {
            "attribute_group_name": "General",
            "sort_order": "1",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "advanced_slider_items",
                "sort_order": "1"
              }
            ]
          },
          {
            "attribute_group_name": "Settings",
            "sort_order": "2",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "fade",
                "sort_order": "1"
              },
              {
                "attribute_code": "autoplay",
                "sort_order": "2"
              },
              {
                "attribute_code": "autoplay_speed",
                "sort_order": "3"
              },
              {
                "attribute_code": "is_infinite",
                "sort_order": "4"
              },
              {
                "attribute_code": "show_arrows",
                "sort_order": "5"
              },
              {
                "attribute_code": "show_dots",
                "sort_order": "6"
              },
              {
                "attribute_code": "slider_advanced_settings",
                "sort_order": "7"
              }
            ]
          },
          {
            "attribute_group_name": "Advanced",
            "sort_order": "3",
            "default_id": "0",
            "attributes": [
              {
                "attribute_code": "css_classes",
                "sort_order": "1"
              }
            ]
          }
        ]
      }
    }
  ],
  "content_apps": [],
  "attributes": [
    {
      "attribute_code": "accordion_items",
      "attribute_model": null,
      "backend_model": "eav\/entity_attribute_backend_array",
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "child_entity",
      "frontend_label": ["Accordion Items"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "accordion_item"
    },
    {
      "attribute_code": "advanced_slider_items",
      "attribute_model": null,
      "backend_model": "eav\/entity_attribute_backend_array",
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "child_entity",
      "frontend_label": ["Slides"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "advanced_slider_item"
    },
    {
      "attribute_code": "alt_tag",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Alternative Text"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "anchor_id",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Identifier"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "app_display",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "select",
      "frontend_label": ["Display Type"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_table",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false,
      "option": {
        "value": {
          "option_0": ["Grid"],
          "option_1": ["List"]
        },
        "order": {
          "option_0": "",
          "option_1": ""
        },
        "delete": {
          "option_0": "",
          "option_1": ""
        }
      }
    },
    {
      "attribute_code": "app_entity_collection",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["App Id"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "search\/app\/collection",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "app_entity_count",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Entity Count"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "app_entity_id",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Entity ID"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "search\/app\/entity",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "autoplay",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Autoplay"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Do you want the slider to rotate on its own",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "autoplay_speed",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Autoplay Speed"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Speed in milliseconds (5000 = 5 seconds)",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "background_image",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "image",
      "frontend_label": ["Background Image"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "block_id",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Static Block"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "search\/staticblock",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "button_items",
      "attribute_model": null,
      "backend_model": "eav\/entity_attribute_backend_array",
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "child_entity",
      "frontend_label": ["Buttons"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "button_item"
    },
    {
      "attribute_code": "button_text",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Button Text"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "category_id",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Category"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "search\/category",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "color",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Color"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "color",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "css_classes",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["CSS Classes"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "tags",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "fade",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Fade"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "The fade only works if you are showing one slide at a time.",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "has_lightbox",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Has Lightbox?"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "has_overlay",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Has Overlay Background"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "This will add a semi transparent overlay behind the slide content.",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "heading_type",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "select",
      "frontend_label": ["Heading Type"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_table",
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false,
      "option": {
        "value": {
          "option_0": ["h2"],
          "option_1": ["h3"],
          "option_2": ["h4"],
          "option_3": ["h5"],
          "option_4": ["h6"]
        },
        "order": {
          "option_0": "",
          "option_1": "",
          "option_2": "",
          "option_3": "",
          "option_4": ""
        },
        "delete": {
          "option_0": "",
          "option_1": "",
          "option_2": "",
          "option_3": "",
          "option_4": ""
        }
      }
    },
    {
      "attribute_code": "hide_out_of_stock",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Hide out of stock products"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "hr_height",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Height"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "How thick do you want the HR to be? Defaults to 1px.",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "hr_width",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Width"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Please specify the width of the horizontal rule. Should be a percentage or px width (e.g. 50px or 100%)",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "html",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "textarea",
      "frontend_label": ["HTML"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "image",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "image",
      "frontend_label": ["Image"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "is_infinite",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Is Infinite"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "label",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Label"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "link_text",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Link Text"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "link_url",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Link Url"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "map",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Map"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "You can move the pin by double clicking or dragging it where you want.\r\n\r\nTo alter the zoom please use the controls",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "map",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "map_height",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Height"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Please enter a value followed by the unit e.g. 300px",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "map_width",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Width"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Please enter a value followed by the unit e.g. 100%",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "mobile_image",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "image",
      "frontend_label": ["Mobile Image"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "open_on_load",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Open on load"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Do you want this to be open on page load",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "placeholder",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Placeholder"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "product_count",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Product Count"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Defaults to 4. ",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "product_display",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "select",
      "frontend_label": ["Product Display"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_table",
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false,
      "option": {
        "value": {
          "option_0": ["Grid"],
          "option_1": ["List"]
        },
        "order": {
          "option_0": "",
          "option_1": ""
        },
        "delete": {
          "option_0": "",
          "option_1": ""
        }
      }
    },
    {
      "attribute_code": "product_id",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Product"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "Search by name or SKU",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "search\/product",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "show_arrows",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Show arrows"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "show_caption",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Show Caption"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "show_dots",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Show dots"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "slider_items",
      "attribute_model": null,
      "backend_model": "eav\/entity_attribute_backend_array",
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "child_entity",
      "frontend_label": ["Slides"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "slider_item"
    },
    {
      "attribute_code": "slider_advanced_settings",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "textarea",
      "frontend_label": ["Slider Advanced Settings"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": "see http:\/\/kenwheeler.github.io\/slick\/ for more information on passing data to the slider",
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "slides_to_scroll",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Slides to scroll"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "slides_to_show",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Slides to show"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "tabs_items",
      "attribute_model": null,
      "backend_model": "eav\/entity_attribute_backend_array",
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "child_entity",
      "frontend_label": ["Tabs"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "tabs_item"
    },
    {
      "attribute_code": "target_blank",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "int",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "boolean",
      "frontend_label": ["Open in new window?"],
      "frontend_class": null,
      "source_model": "eav\/entity_attribute_source_boolean",
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "textarea",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "text",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "textarea",
      "frontend_label": ["Content"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "1",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "title",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Title"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "0",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "title_tag",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Title Tag"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": null,
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "video_height",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Height"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    },
    {
      "attribute_code": "video_url",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Video URL"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "1",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": "video",
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": "hr"
    },
    {
      "attribute_code": "video_width",
      "attribute_model": null,
      "backend_model": null,
      "backend_type": "varchar",
      "backend_table": null,
      "frontend_model": null,
      "frontend_input": "text",
      "frontend_label": ["Video Width"],
      "frontend_class": null,
      "source_model": null,
      "is_required": "0",
      "is_user_defined": "1",
      "is_unique": "0",
      "note": null,
      "is_global": "0",
      "is_wysiwyg_enabled": "0",
      "is_visible": "1",
      "content_scope": "0",
      "frontend_input_renderer": null,
      "widget": null,
      "data_model": null,
      "template": null,
      "list_template": null,
      "additional_data": [],
      "entity_allowed_block_type": false
    }
  ]
}        
        ');
    }
}
