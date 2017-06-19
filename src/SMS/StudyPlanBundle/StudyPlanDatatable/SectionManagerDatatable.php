<?php

namespace SMS\StudyPlanBundle\StudyPlanDatatable;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class SectionDatatable
 *
 * @package SMS\StudyPlanBundle\EstablishmentDatatable
 */
class SectionManagerDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->callbacks->set(array(
        'row_callback' => array(
            'template' => 'Pagination/row_callback.js.twig',
            )
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('section_results'),
            'type' => 'GET',
            'pipeline' => 0
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => "<'dt-uikit-header'<'uk-grid'<'uk-width-medium-2-3'l><'uk-width-medium-1-3'f>>><'uk-overflow-container'tr><'dt-uikit-footer'<'uk-grid'<'uk-width-medium-3-10'i><'uk-width-medium-7-10'p>>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(1, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' =>  'uikit',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'class' => "uk-table dataTable table_check",
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
            'use_integration_options' => false,
            'force_dom' => true,
            'row_id' => 'id'
        ));

        $this->columnBuilder
            ->add('sectionName', 'column', array(
                'title' => $this->translator->trans('section.field.sectionName'),
            ))
            ->add('grade.gradeName', 'column', array(
                'title' => $this->translator->trans('grade.field.gradeName'),
            ))
            ->add('user.username', 'column', array(
                'title' => $this->translator->trans('author.creator')
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'title' => 'Actions',
                'start_html' => '<div class="wrapper_example_class">',
                'end_html' => '</div>',
                'actions' => array(
                    array(
                        'route' => '',
                        'icon' => '&#xE150;',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                        ),
                    ),
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'SMS\EstablishmentBundle\Entity\Section';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'section_manager_datatable';
    }
}