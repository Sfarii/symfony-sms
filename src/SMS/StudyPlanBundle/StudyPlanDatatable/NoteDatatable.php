<?php

namespace SMS\StudyPlanBundle\StudyPlanDatatable;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class NoteDatatable
 *
 * @package SMS\StudyPlanBundle\StudyPlanDatatable
 */
class NoteDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->callbacks->set(array(
        'row_callback' => array(
            'template' => 'Pagination/editable_callback.js.twig',
            )
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => "<'dt-uikit-header'<'uk-grid'<'uk-width-medium-2-3'l><'uk-width-medium-1-3'f>>><'uk-overflow-container'tr><'dt-uikit-footer'<'uk-grid'<'uk-width-medium-3-10'i><'uk-width-medium-7-10'p>>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' =>  'uikit',
            'scroll_collapse' => false,

            'search_delay' => 0,
            'state_duration' => 7200,
            'class' => "uk-table uk-table-striped",
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => true,
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('note_results'),
            'type' => 'GET',
            'pipeline' => 0
        ));

        $this->columnBuilder
                ->add('student.recordeNumber', 'column', array(
                    'title' => $this->translator->trans('student.field.recordeNumber')
                ))
                ->add('student.firstName', 'column', array(
                    'title' => $this->translator->trans('student.field.firstName'),
                ))
                ->add('student.studentParent.fatherName', 'column', array(
                    'title' => $this->translator->trans('studentparent.field.fatherName'),
                ))
                ->add('student.lastName', 'column', array(
                    'title' => $this->translator->trans('student.field.lastName'),
                ))
                ->add('mark', 'column', array(
                    'title' => $this->translator->trans('note.field.mark'),
                    'editable' => true,
                ))

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'SMS\StudyPlanBundle\Entity\Note';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'note_datatable';
    }
}
