<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Facades\App\Repositories\DirectoryRepository;
use Facades\App\Repositories\FileRepository;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(FileRequest $request): JsonResponse
    {
        if ($errors = $request->validating('store')) {
            return response()->json(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    'results' => [],
                    'errors' => $errors,
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $parentID = $dirID = DirectoryRepository::findByID(id: $request->input('parent_id'));

        if ($dirID->is_root == 0) {
            $dirID = $dirID->rootid;
        }

        $rootDir = $dirID->name;
        $uploadDir = $parentID->breadcrumbs_string;

        switch ($rootDir) {
            case 'Music':
                $icon = 'storage/icons/mp3.png';
                $rulesType = 'musRules';
                break;

            case 'Pictures':
                $icon = 'storage/icons/jpg.png';
                $rulesType = 'imgRules';
                break;

            case 'Videos':
                $icon = 'storage/icons/mov.png';
                $rulesType = 'vidRules';
                break;

            default:
                $icon = 'storage/icons/doc.png';
                $rulesType = 'docRules';
                break;
        }

        if ($errors = $request->validating($rulesType)) {
            return response()->json(
                [
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                    'results' => [],
                    'errors' => $errors,
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $rfile = $request->file('file');
        $file = [
            'fileable_type' => get_class($parentID),
            'fileable_id' => $parentID->id,
            'filename' => $rfile->hashName(),
            'filename_ori' => $rfile->getClientOriginalName(),
            'path' => $uploadDir,
            'icon' => $icon,
            'extension' => $rfile->extension(),
            'mime_type' => $rfile->getClientMimeType(),
            'size' => $rfile->getSize(),
        ];

        if ($rootDir == 'Pictures') {
            $dimension = $rfile->dimensions();
            $orientation = 'square';
            if ($dimension[0] > $dimension[1]) {
                $orientation = 'landscape';
            } elseif ($dimension[0] < $dimension[1]) {
                $orientation = 'portrait';
            }

            $file['width'] = $dimension[0] ?? null;
            $file['heigth'] = $dimension[1] ?? null;
            $file['orientation'] = $orientation;
        }


        if (!empty($rfile->storeAs($file['path'], $file['filename']))) {
            if (FileRepository::storing($file)) {

                return response()->json(
                    [
                        'code' => Response::HTTP_CREATED,
                        'message' => Response::$statusTexts[Response::HTTP_CREATED],
                        'results' => [],
                        'errors' => [],
                    ],
                    Response::HTTP_CREATED
                );
            }
        }

        return response()->json(
            [
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => Response::$statusTexts[Response::HTTP_BAD_REQUEST],
                'results' => [],
                'errors' => ['file' => 'File upload unsuccessful'],
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
