<?php
/**
 * @author         Messier 1001 <messier.1001+code@gmail.com>
 * @copyright  (c) 2016, Messier 1001
 * @package        Messier\Observer
 * @since          2017-03-20
 * @version        0.1.0
 */


declare( strict_types = 1 );


namespace Messier\Observer;


/**
 * Each observer must implement this interface.
 *
 * @since v0.1.0
 */
interface IObserver
{


   /**
    * Is called by an observed observable to inform the observer about an update.
    *
    * @param \Messier\Observer\IObservable $observable The observed observable that should be updated
    * @param mixed                         $extras     Optional data from observed
    */
   public function onUpdate( IObservable $observable, $extras = null );

   /**
    * Is called by an observable to inform, that the observed defined observable will now inform the
    * observer about something.
    *
    * @param \Messier\Observer\IObservable $observable
    * @return mixed
    */
   public function onSubscribe( IObservable $observable );

   /**
    * Is called by an observable to inform it that the observed defined observable will not longer inform the
    * observer about something.
    *
    * @param \Messier\Observer\IObservable $observable
    * @return mixed
    */
   public function onUnsubscribe( IObservable $observable );


}

