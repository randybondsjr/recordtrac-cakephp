<?php 
class Record extends AppModel {
  
  public $actsAs = array(
    'Upload.Upload' => array(
        'filename'=> array(
          'thumbnails' => false
        )
    )
  );
 	public $validate = array(
    'description' => array(
      'rule' => 'notEmpty'
    ),
    'filename' => array(
      'rule1' => array(
        'rule' => array(
          'isValidMimeType', 
          array('application/pdf', 
                'image/png', 
                'application/postscript', 
                'application/epub+zip', 
                'application/msword', 
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
                'application/vnd.ms-powerpoint',
                'application/vnd.ms-powerpoint',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'text/plain',
                'application/rtf',
                'image/jpeg',
                'image/gif',
                'application/zip'
               ), 
          false
        ),
        'message' => '<p>File type is not allowed</p>
                      <p>Allowed File Types:</p>
                      <ul>
                      <li>Adobe PDF (.pdf)</li>
                      <li>Adobe PostScript (.ps)</li>
                      <li>Electronic Publication (.epub)</li>
                      <li>Microsoft Word (.doc/ .docx)</li>
                      <li>Microsoft PowerPoint (.ppt/.pps/.pptx)</li>
                      <li>Microsoft Excel (.xls/.xlsx)</li>
                      <li>Plain text (.txt)</li>
                      <li>Rich text format (.rtf)</li>
                      <li>Image Formats (.png/.jpg/.gif)</li>
                      <li>Zip Files (.zip)</li>
                      </ul>
                     ',
        'allowEmpty' => true
      ),
      'rule2' => array(
        'rule' => 'isUnderPhpSizeLimit',
        'message' => 'File exceeds upload filesize limit'
      )
    )
  );

}