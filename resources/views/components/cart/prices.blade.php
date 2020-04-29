<tr>
    <td colspan="4" class="text-right pt-0 pb-1 no-border">
        Tax ({{ $taxRate }}%)
    </td>
    <td class="text-right pt-0 pb-1 no-border">
        {{ $taxAmount }}
    </td>
    <td class="pt-0 pb-1 no-border"></td>
</tr>

<tr>
    <td colspan="4" class="text-right pt-0 pb-1 no-border">
        Shipping & Handling:
    </td>
    <td class="text-right pt-0 pb-1 no-border">
        {{ $shippingCosts }}
    </td>
    <td class="pt-0 pb-1 no-border"></td>
</tr>

<tr>
    <td colspan="4" class="text-right uppercase font-bold no-border">
        Grand Total:
    </td>
    <td class="text-right font-bold no-border">
        {{ $grandTotal }}
    </td>
    <td class="no-border"></td>
</tr>