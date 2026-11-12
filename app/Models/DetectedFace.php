<?php

namespace App\Models;

class DetectedFace
{
    public function __construct(
        public readonly string $id,
        public readonly string $label,
        public readonly int $ymin,
        public readonly int $xmin,
        public readonly int $ymax,
        public readonly int $xmax,
        public bool $blurred = true,
    ) {}

    /**
     * Build a validated DetectedFace from a Gemini response item.
     */
    public static function fromGeminiItem(array $item, int $index): ?self
    {
        $box = $item['box_2d'] ?? null;

        if (!is_array($box) || count($box) !== 4) {
            return null;
        }

        foreach ($box as $coord) {
            if (!is_numeric($coord)) {
                return null;
            }
        }

        $clamp = static fn (mixed $value): int => max(0, min(1000, (int) round((float) $value)));

        $ymin = $clamp($box[0]);
        $xmin = $clamp($box[1]);
        $ymax = $clamp($box[2]);
        $xmax = $clamp($box[3]);

        // Ensure proper ordering in case coordinates are swapped
        if ($ymin > $ymax) {
            [$ymin, $ymax] = [$ymax, $ymin];
        }
        if ($xmin > $xmax) {
            [$xmin, $xmax] = [$xmax, $xmin];
        }

        // Ignore degenerate/zero-area boxes
        if (($ymax - $ymin) < 2 || ($xmax - $xmin) < 2) {
            return null;
        }

        $rawLabel = trim((string) ($item['label'] ?? ''));
        $label = $rawLabel !== '' ? $rawLabel : 'Face ' . ($index + 1);

        return new self(
            id: 'face_' . ($index + 1),
            label: $label,
            ymin: $ymin,
            xmin: $xmin,
            ymax: $ymax,
            xmax: $xmax,
            blurred: true,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
            'box' => [
                'ymin' => $this->ymin,
                'xmin' => $this->xmin,
                'ymax' => $this->ymax,
                'xmax' => $this->xmax,
            ],
            'blurred' => $this->blurred,
        ];
    }
}